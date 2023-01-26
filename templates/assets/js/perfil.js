window.onload = async () => {

    await getDatos();
    getCompras();
    getComentarios();

}


async function getDatos() {
    try {
        const response = await fetch('infoPerfilUsuario');

        let info4 = await response.json();
        info4.forEach(element => {
            // console.log(element);
            document.getElementById("nombre").value = element['nombre'];
            document.getElementById("apellidos").value = element['apellidos'];
            document.getElementById("email").value = element['email'];
            document.getElementById("pass").value = element['password'];
            document.getElementById("monedero").value = element['monedero'];
            document.getElementById("id").value = element['id'];


        })
    } catch (error) {

    }


}


async function getCompras() {
    try {

        const response = await fetch('comprasUsuario');

        let info4 = await response.json();
        if (info4[0] == 0) {
            return;
        }
        let tabla = document.getElementById("tablaCompra");
        let trCabecera = document.createElement("tr");
        let th1 = document.createElement("th");
        th1.textContent = "Producto";
        let th2 = document.createElement("th");
        th2.textContent = "Fecha";
    
        trCabecera.appendChild(th1);
        trCabecera.appendChild(th2);
        tabla.appendChild(trCabecera);
        info4.forEach(element => {
            let tr = document.createElement("tr");
            let td1 = document.createElement("td");
            td1.textContent = element['nombre'];
            let td2 = document.createElement("td");
            td2.textContent = element['fecha'];
    
            tr.appendChild(td1);
            tr.appendChild(td2);
            tabla.appendChild(tr);
        });
    } catch (error) {

    }
   





}
async function getComentarios() {

    try {
        const response = await fetch('comentariosUsuario');

        let info4 = await response.json();
        if (info4[0] == 0) {
            return;
        }
    
        let tabla = document.getElementById("tablaComentario");
        let trCabecera = document.createElement("tr");
        let th1 = document.createElement("th");
        th1.textContent = "Producto";
        let th2 = document.createElement("th");
        th2.textContent = "Fecha";
        let th3 = document.createElement("th");
        th3.textContent = "Comentario";
    
        trCabecera.appendChild(th1);
        trCabecera.appendChild(th2);
        trCabecera.appendChild(th3);
        tabla.appendChild(trCabecera);
        info4.forEach(element => {
            let tr = document.createElement("tr");
            let td1 = document.createElement("td");
            td1.textContent = element['nombre'];
            let td2 = document.createElement("td");
            td2.textContent = element['fecha'];
            let td3 = document.createElement("td");
            td3.textContent = element['comentario'];
    
            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);
            tabla.appendChild(tr);
        });
    
        
    } catch (error) {
        
    }

    
}
function eliminar(){
     location.href="eliminarUsuarioPublico";
   
}


