$(document).ready(function () {
    // Función para cargar los datos de los vehículos
    function cargarVehiculos(filtros = {}) {
        $.ajax({
            url: '/api/v1/privatevehicles',
            type: 'GET',
            data: filtros,
            success: function (response) {
                // Actualizar la interfaz con los datos de los vehículos obtenidos
                console.log(response); // Aquí puedes manejar la respuesta como desees
            },
            error: function (xhr, status, error) {
                console.error('Error al cargar los vehículos:', error);
            }
        });
    }

    // Evento de cambio en cualquier filtro
    $('.filter-select').change(function () {
        var yearFilter = $('#yearFilter').val();
        var brandFilter = $('#brandFilter').val();
        var fuelTypeFilter = $('#fuelTypeFilter').val();
        var gearboxFilter = $('#gearboxFilter').val();

        // Crear un objeto con los filtros seleccionados
        var filtros = {
            year: yearFilter,
            brand: brandFilter,
            fuelType: fuelTypeFilter,
            gearbox: gearboxFilter
        };

        // Cargar los vehículos con los filtros seleccionados
        cargarVehiculos(filtros);
    });

    // Evento de clic en el botón de búsqueda
    $('#searchBtn').click(function () {
        var searchInput = $('#searchInput').val();

        // Si se ha ingresado algún valor en el campo de búsqueda, agregarlo como filtro
        if (searchInput.trim() !== '') {
            var filtros = {
                search: searchInput
            };
            // Cargar los vehículos con el término de búsqueda
            cargarVehiculos(filtros);
        }
    });
});
