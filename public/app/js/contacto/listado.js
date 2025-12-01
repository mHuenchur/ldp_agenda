let dataTable = new simpleDatatables.DataTable("#myTable", {
    labels: {
    placeholder: "Buscar…",
    perPage: "contactos por página",              // “entries per page”
    noRows: "No hay registros",
    info: "Mostrando {start} a {end} de {rows}", // “Showing 1 to 3 of 3 entries”
    noResults: "No se encontraron resultados",
    },
	searchable: true,
	fixedHeight: true
})