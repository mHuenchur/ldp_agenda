let usuarioService = {
    updateUsuario: (data) => {
        return fetch("usuario/update", {
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
    updateClave: (data) => {
        return fetch("usuario/updateClave", {
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
    }
}