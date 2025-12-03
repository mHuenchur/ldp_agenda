let categoriaService = {
    saveCategoria: (data) => {
        return fetch("categoria/save", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if(!response.ok){
                throw new Error(response.status);
            }
            return response.json()
        })
        .catch(error => {
            console.error("ERROR EN LA PETICION ", error)
        });
    },
    updateCategoria: (data) => {
        return fetch("categoria/update", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if(!response.ok){
                throw new Error(response.status);
            }
            return response.json()
        })
        .catch(error => {
            console.error("ERROR EN LA PETICION ", error)
        });
    },
    deleteCategoria: (data) => {
        return fetch(`categoria/delete/${data}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
        })
        .then(response => {
            if(!response.ok){
                throw new Error(response.status);
            }
            return response.json()
        })
        .catch(error => {
            console.error("ERROR EN LA PETICION ", error)
        });
    }
}