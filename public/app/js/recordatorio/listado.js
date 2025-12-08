let dataTableProximos = new simpleDatatables.DataTable("#TableRecordatorioVigente", {
    labels: {
    placeholder: "Buscar…",
    perPage: "recordatorios por página",              // “entries per page”
    noRows: "No hay registros",
    info: "Mostrando {start} a {end} de {rows}", // “Showing 1 to 3 of 3 entries”
    noResults: "No se encontraron resultados",
    },
	searchable: true,
	fixedHeight: true
})

let dataTableVencidos = new simpleDatatables.DataTable("#TableRecordatorioVencido", {
    labels: {
    placeholder: "Buscar…",
    perPage: "recordatorios por página",              // “entries per page”
    noRows: "No hay registros",
    info: "Mostrando {start} a {end} de {rows}", // “Showing 1 to 3 of 3 entries”
    noResults: "No se encontraron resultados",
    },
	searchable: true,
	fixedHeight: true
})