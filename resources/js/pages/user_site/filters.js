document.addEventListener('DOMContentLoaded', function () {
    let allVehicles = []; // Variable para almacenar todos los datos de los vehículos obtenidos de la API
    const pageSize = 3; // Tamaño de página para la paginación
    let currentPage = 1; // Página actual
    let totalPages = 1; // Total de páginas disponibles

    const vehicleListContainer = document.createElement('div');
    vehicleListContainer.classList.add('container', 'mt-5');
    vehicleListContainer.setAttribute('id', 'vehicleList');

    // Agregar el contenedor al cuerpo del documento
    document.body.appendChild(vehicleListContainer);

    // Función para realizar la solicitud de datos de vehículos
    const fetchVehicles = (page = 1) => {
        fetch(`/api/v1/privatevehicles?page=${page}&limit=${pageSize}`)
            .then(response => response.json())
            .then(data => {
                allVehicles = data.data; // Accede a data.data en lugar de data.vehicles
                totalPages = data.pagination.last_page; // Guardar el total de páginas
                renderVehicles(allVehicles);
                toggleLoadMoreButton(); // Mostrar u ocultar el botón "Cargar más"
                populateFilters(); // Llenar los filtros disponibles
            })
            .catch(error => console.error('Error fetching vehicles:', error));
    };
    const populateFilters = () => {
        const yearFilter = document.getElementById('yearFilter');
        const brandFilter = document.getElementById('brandFilter');
        const fuelTypeFilter = document.getElementById('fuelTypeFilter');
        const gearboxFilter = document.getElementById('gearboxFilter');

        const years = new Set();
        const brands = new Set();
        const fuelTypes = new Set();
        const gearboxTypes = new Set();

        allVehicles.forEach(vehicle => {
            years.add(vehicle.año_desde);
            brands.add(vehicle.marca);
            fuelTypes.add(vehicle.combustible);
            gearboxTypes.add(vehicle.cambio);
        });

        populateFilter(yearFilter, years);
        populateFilter(brandFilter, brands);
        populateFilter(fuelTypeFilter, fuelTypes);
        populateFilter(gearboxFilter, gearboxTypes);
    };




    const filterAndRenderVehicles = () => {
        const year = document.getElementById('yearFilter').value;
        const brand = document.getElementById('brandFilter').value;
        const fuelType = document.getElementById('fuelTypeFilter').value;
        const gearbox = document.getElementById('gearboxFilter').value;
        const searchText = document.getElementById('searchInput').value.toLowerCase();

        // Filtrar sobre todos los vehículos
        const filteredVehicles = allVehicles.filter(vehicle => {
            return (!year || vehicle.año_desde == year) &&
                (!brand || vehicle.marca.toLowerCase().includes(brand.toLowerCase())) &&
                (!fuelType || vehicle.combustible.toLowerCase().includes(fuelType.toLowerCase())) &&
                (!gearbox || vehicle.cambio.toLowerCase().includes(gearbox.toLowerCase())) &&
                (vehicle.marca.toLowerCase().includes(searchText) ||
                    vehicle.modelo.toLowerCase().includes(searchText) ||
                    vehicle.version.toLowerCase().includes(searchText) ||
                    vehicle.codigo.toLowerCase().includes(searchText));
        });

        // Mostrar los vehículos filtrados
        renderVehicles(filteredVehicles);
    };

    // Función para llenar un filtro específico
    const populateFilter = (selectElement, options) => {
        selectElement.innerHTML = ''; // Limpiar las opciones anteriores

        // Crear la opción "Todos" y establecerla como seleccionada por defecto
        const allOption = new Option('Todos', '');
        allOption.selected = true;
        selectElement.appendChild(allOption);

        // Llenar las opciones disponibles
        options.forEach(option => {
            const optionElement = document.createElement('option');
            optionElement.value = option;
            optionElement.textContent = option;
            selectElement.appendChild(optionElement);
        });
    };
    // Función para mostrar los vehículos en la página
    const renderVehicles = (vehicleData) => {
        const vehicleList = document.getElementById('vehicleList');

        vehicleList.innerHTML = ''; // Limpiar la lista antes de mostrar los nuevos resultados

        vehicleData.forEach(vehicle => {
            const card = document.createElement('div');
            card.classList.add('col');
            card.innerHTML = `
            <div class="card mx-4">
                <img src="${vehicle.image_url}" class="card-img-top img-fluid h-100" alt="${vehicle.marca} ${vehicle.modelo} ${vehicle.version} ${vehicle.codigo}">
                <div class="card-body">
                    <h5 class="card-title">${vehicle.marca} ${vehicle.modelo}${vehicle.version} ${vehicle.codigo}</h5>
                    <p class="card-text">Año: ${vehicle.año_desde}-${vehicle.año_hasta}</p>
                    <p class="card-text">Combustible: ${vehicle.combustible}</p>
                    <p class="card-text">Cambio: ${vehicle.cambio}</p>
                    <button class="btn btn-primary btn-details" data-id="${vehicle.id}">Más Detalles</button>
                </div>
            </div>
        `;
            vehicleList.appendChild(card);
        });

        // Agregar evento de clic a los botones de "Más Detalles"
        document.querySelectorAll('.btn-details').forEach(btn => {
            btn.addEventListener('click', () => {
                const vehicleId = btn.getAttribute('data-id');
                showDetails(vehicleId);
            });
        });
    };

    // Función para cargar más vehículos cuando se presiona el botón "Cargar más"
    const loadMoreVehicles = () => {
        currentPage++; // Incrementar el número de página actual

        // Realizar la solicitud a la API para obtener los vehículos de la siguiente página
        fetchVehicles(currentPage);
    };

    // Función para mostrar u ocultar el botón "Cargar más" según haya más páginas disponibles
    const toggleLoadMoreButton = () => {
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        if (currentPage < totalPages) {
            loadMoreBtn.style.display = 'block';
            loadMoreBtn.classList.add('mx-auto'); // Agregar clase para centrar horizontalmente
        } else {
            loadMoreBtn.style.display = 'none';
        }
    };

    // Realizar la solicitud inicial para obtener datos de vehículos al cargar la página
    fetchVehicles();

    // Agregar evento de escucha a los elementos de filtro para actualizar los vehículos mostrados
    document.querySelectorAll('.filter-select').forEach(select => {
        select.addEventListener('change', filterAndRenderVehicles);
    });

    // Agregar evento de escucha al campo de búsqueda para actualizar los vehículos mostrados
    document.getElementById('searchInput').addEventListener('input', filterAndRenderVehicles);

    // Agregar evento de escucha al botón "Cargar más" para cargar más vehículos
    document.getElementById('loadMoreBtn').addEventListener('click', loadMoreVehicles);

    const showDetails = (vehicleId) => {
        fetch(`/api/v1/privatevehicles/${vehicleId}`)
            .then(response => response.json())
            .then(vehicle => {
                // Sumar vehicle.c_aceite y vehicle.proximo_c_aceite
                const proximaRevision = vehicle.c_aceite + vehicle.proximo_c_aceite;

                // Crear el contenido HTML para los detalles del vehículo
                const detailsHTML = `
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="card mb-3 vehicle-card">
                                <div class="row no-gutters">
                                    <div class="col-md-4 bg-light d-flex flex-column align-items-center justify-content-center">
                                        <img src="${vehicle.image_url}" class="card-img img-fluid" alt="${vehicle.marca} ${vehicle.modelo}">
                                        <div class="mt-3 text-center">
                                            <p class="text-muted">${vehicle.descripcion}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">${vehicle.marca} ${vehicle.modelo}${vehicle.version} ${vehicle.codigo}</h5>
                                            <p class="card-text">Año: ${vehicle.año_desde} - ${vehicle.año_hasta}</p>
                                            <h6 class="mt-4">Revisiones:</h6>
                                            <div class="revision-list mb-4">
                                                <ul class="list-group">
                                                    <li class="list-group-item revision-list-item p-2">
                                                        <strong>Cambio de aceite:</strong><br>
                                                        Kilometraje: <span id="mileageValue">${vehicle.c_aceite}</span>
                                                        <button class="btn btn-sm btn-outline-primary ml-2 editMileageBtn"><i class="fas fa-pencil-alt"></i></button><br>
                                                        Próxima revisión: ${proximaRevision} km
                                                    </li>
                                                </ul>
                                            </div>
                                            <p><i class="fas fa-horse-head"></i> ${vehicle.cv} CV</p>
                                            <p><i class="fas fa-cogs"></i> ${vehicle.torque} Nm</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

                // Agregar el contenido HTML al contenedor de detalles del vehículo
                document.getElementById('vehicleDetailsContainer').innerHTML = detailsHTML;

                // Agregar evento de clic a los botones de edición de kilometraje
                document.querySelectorAll('.editMileageBtn').forEach(btn => {
                    btn.addEventListener('click', editMileage);
                });
            })
            .catch(error => console.error('Error fetching vehicle details:', error));
    };

    function editMileage() {
        const newMileageInput = prompt('Ingrese el nuevo kilometraje:'); // Solicitar al usuario el nuevo kilometraje

        // Verificar si el usuario ingresó un nuevo kilometraje
        if (newMileageInput !== null && !isNaN(newMileageInput)) {
            const newMileage = parseInt(newMileageInput.replace(/\D/g, '')); // Convertir a número entero y eliminar cualquier caracter no numérico

            // Obtener el token CSRF del meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            // Obtener el tipo de kilometraje
            const mileageType = 'c_aceite'; // Definir el tipo de kilometraje aquí

            // Actualizar el valor del kilometraje mostrado
            const mileageValueElement = this.parentNode.querySelector('#mileageValue');
            mileageValueElement.textContent = newMileage; // No agregamos 'km' aquí

            // Enviar el nuevo kilometraje al servidor utilizando fetch
            fetch('/api/v1/vehicles/change-mileage', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken // Agregar el token CSRF al encabezado
                },
                body: JSON.stringify({
                    mileage_type: mileageType, // Tipo de kilometraje
                    new_mileage: newMileage // Nuevo kilometraje
                })
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al enviar el nuevo kilometraje al servidor');
                    }
                    // Aquí puedes manejar la respuesta del servidor si es necesario
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Se produjo un error al enviar el nuevo kilometraje al servidor.');
                });
        } else {
            alert('Ingrese un valor válido para el kilometraje.'); // Mostrar un mensaje de alerta si el valor ingresado no es válido
        }
    }



});
