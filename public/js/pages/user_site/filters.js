document.addEventListener('DOMContentLoaded', function () {
    let allVehicles = []; // Variable para almacenar todos los datos de los vehículos obtenidos de la API
    const pageSize = 3; // Tamaño de página para la paginación
    let currentPage = 1; // Página actual

    const vehicleDetailsContainer = document.createElement('div');
    vehicleDetailsContainer.classList.add('container', 'mt-5');
    vehicleDetailsContainer.setAttribute('id', 'vehicleDetails');

    // Agregar el contenedor al cuerpo del documento
    document.body.appendChild(vehicleDetailsContainer);

    // Función para realizar la solicitud de datos de vehículos
    const fetchVehicles = (page = 1) => {
        fetch(`/api/v1/privatevehicles?page=${page}&limit=${pageSize}`)
            .then(response => response.json())
            .then(data => {
                allVehicles = [...allVehicles, ...data.vehicles.data];
                renderVehicles(allVehicles);

                // Llama a la función para generar las opciones de filtro después de obtener los datos de los vehículos
                generateFilterOptions(allVehicles);
            })
            .catch(error => console.error('Error fetching vehicles:', error));
    };

    // Función para generar opciones de filtro
    const generateFilterOptions = (vehicles) => {
        const uniqueValues = (key) => [...new Set(vehicles.map(vehicle => vehicle[key]))];

        const yearFilter = document.getElementById('yearFilter');
        const brandFilter = document.getElementById('brandFilter');
        const fuelTypeFilter = document.getElementById('fuelTypeFilter');
        const gearboxFilter = document.getElementById('gearboxFilter');

        appendOptions(uniqueValues('año'), yearFilter);
        appendOptions(uniqueValues('marca'), brandFilter);
        appendOptions(uniqueValues('tipo_combustible'), fuelTypeFilter);
        appendOptions(uniqueValues('tipo_cambio'), gearboxFilter);
    };

    // Función para agregar opciones a un selector de filtro
    const appendOptions = (options, selectElement) => {
        selectElement.innerHTML = ''; // Limpiar el selector antes de agregar las nuevas opciones
        options.forEach(option => {
            const optionElement = document.createElement('option');
            optionElement.value = option;
            optionElement.textContent = option;
            selectElement.appendChild(optionElement);
        });
    };

    // Función para filtrar y mostrar los vehículos
    const filterAndRenderVehicles = () => {
        const year = document.getElementById('yearFilter').value;
        const brand = document.getElementById('brandFilter').value;
        const fuelType = document.getElementById('fuelTypeFilter').value;
        const gearbox = document.getElementById('gearboxFilter').value;
        const searchText = document.getElementById('searchInput').value.toLowerCase();

        // Filtrar sobre todos los vehículos
        const filteredVehicles = allVehicles.filter(vehicle => {
            return (!year || vehicle.año === year) &&
                (!brand || vehicle.marca.toLowerCase().includes(brand.toLowerCase())) &&
                (!fuelType || vehicle.tipo_combustible === fuelType) &&
                (!gearbox || vehicle.tipo_cambio === gearbox) &&
                (vehicle.marca.toLowerCase().includes(searchText) ||
                    vehicle.año.includes(searchText) ||
                    vehicle.tipo_combustible.toLowerCase().includes(searchText) ||
                    vehicle.tipo_cambio.toLowerCase().includes(searchText));
        });

        // Actualizar allVehicles con los vehículos filtrados
        allVehicles = filteredVehicles;

        // Mostrar los vehículos filtrados
        renderVehicles(filteredVehicles);
    };

    // Función para mostrar los vehículos en la página
    const renderVehicles = (vehicleData) => {
        const vehicleList = document.getElementById('vehicleList');
        vehicleList.innerHTML = ''; // Limpiar la lista de vehículos antes de mostrar los nuevos

        vehicleData.forEach(vehicle => {
            const card = document.createElement('div');
            card.classList.add('col');
            card.innerHTML = `
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">${vehicle.marca} ${vehicle.modelo}</h5>
                    <p class="card-text">Año: ${vehicle.año}</p>
                    <p class="card-text">Combustible: ${vehicle.tipo_combustible}</p>
                    <p class="card-text">Cambio: ${vehicle.tipo_cambio}</p>
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
        const startIndex = (currentPage - 1) * pageSize;
        const endIndex = startIndex + pageSize;

        // Realizar la solicitud a la API para obtener los vehículos de la siguiente página
        fetchVehicles(currentPage);
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
                // Crear el contenido HTML para los detalles del vehículo
                const detailsHTML = `
                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col-md-8 offset-md-2">
                                        <div class="card mb-3 vehicle-card">
                                            <div class="row no-gutters">
                                                <div class="col-md-4 bg-light d-flex flex-column align-items-center justify-content-center">
                                                    <img src="img/header/car.png" class="card-img img-fluid" alt="${vehicle.marca} ${vehicle.modelo}">
                                                    <div class="mt-3 text-center">
                                                        <p class="text-muted">Descripción del vehículo...</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title">${vehicle.marca} ${vehicle.modelo}</h5>
                                                        <p class="card-text">Año: ${vehicle.año}</p>
                                                        <h6 class="mt-4">Revisiones:</h6>
                                                        <div class="revision-list">
                                                            <ul class="list-group">
                                                                <!-- Aquí van las revisiones -->
                                                            </ul>
                                                        </div>
                                                        <p><i class="fas fa-horse-head"></i> ${vehicle.cv} CV</p>
                                                        <p><i class="fas fa-cogs"></i> ${vehicle.nm} Nm</p>
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
            })
            .catch(error => console.error('Error fetching vehicle details:', error));
    };
});
