
let pagina = 0;
let json = [];
let primera = 0;
let columnas;
let tabla;

window.onload = async () => {
    tabla = location.href.substring(location.href.lastIndexOf("/") + 1);
    document.getElementById("tituloTabla").innerHTML = "Tabla " + tabla
    document.getElementById("tituloDatos").innerHTML = "Datos " + tabla

    seleccionar();
    try {
        await getProductos(pagina)


    } catch (noAutorizado) {
        // location.href="admin/login"
    }


    //  setInterval(() => {
    //     json=[];
    // }, 1000);


    // console.log(info);

}

function construirCabecera(column) {
    columnas = Object.keys(column)



    cabecera = document.createElement('tr');

    for (let i = 0; i < columnas.length; i++) {

        var titulo = document.createElement('th');
        var texto = document.createTextNode(columnas[i]);
        titulo.appendChild(texto);
        // var funcion = function () {

        //     this.textContent = columnas[i] + flecha;
        //     ordenar(i);
        // };
        // titulo.onclick = funcion;
        cabecera.appendChild(titulo);

    }

    document.getElementById('cabecera').append(cabecera);




}


async function getProductos(pag) {
    pagina += pag;
    let info;
    if (json[pagina]) {
        info = json[pagina]

    } else {

        const response = await fetch('lista?tabla=' + tabla + '&pagina=' + pagina);

        info = await response.json();

        if (primera == 0) {
            construirCabecera(info[0])
            primera++;

        }

        json[pagina] = info;
    }
    let tbody = document.getElementById('bodyLista');
    tbody.innerHTML = "";


    info.forEach(element => {
        let tr = document.createElement("tr");
        let td = [];
        for (let i = 0; i < columnas.length; i++) {
            td[i] = document.createElement('td');
            td[i].textContent = element[columnas[i]];
        }

        tr.append(...td);
        tbody.append(tr);
    });


}


function seleccionar() {
    switch (tabla) {
        case 'dashboard':
            document.getElementById("dash").classList.add("active")
            document.getElementById("cat").classList.remove("active")
            document.getElementById("usu").classList.remove("active")
            document.getElementById("prod").classList.remove("active")
            break;
        case 'categorias':
            document.getElementById("cat").classList.add("active")
            document.getElementById("prod").classList.remove("active")
            document.getElementById("usu").classList.remove("active")
            document.getElementById("dash").classList.remove("active")            
            break;
            case 'usuarios':
                document.getElementById("usu").classList.add("active")
                document.getElementById("cat").classList.remove("active")
                document.getElementById("prod").classList.remove("active")
                document.getElementById("dash").classList.remove("active")                
                break;
                case 'productos':
                    document.getElementById("prod").classList.add("active")
                    document.getElementById("cat").classList.remove("active")
                    document.getElementById("usu").classList.remove("active")
                    document.getElementById("dash").classList.remove("active")
                    
            break;


    }
}

