let dataTable = new simpleDatatables.DataTable("#TableCategoria", {
    labels: {
    placeholder: "Buscar…",
    perPage: "categorias por página",              // “entries per page”
    noRows: "No hay registros",
    info: "Mostrando {start} a {end} de {rows}", // “Showing 1 to 3 of 3 entries”
    noResults: "No se encontraron resultados",
    },
	searchable: true,
	fixedHeight: true
})