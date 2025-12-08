let recordatorioService = {
    saveRecordatorio: (data) => {
        return fetch("recordatorio/save", {
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
    updateRecordatorio: (data) => {
        return fetch("recordatorio/update", {
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
    deleteRecordatorio: (data) => {
        return fetch(`recordatorio/delete/${data}`, {
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