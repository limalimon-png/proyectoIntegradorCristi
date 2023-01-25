let pagina = 0;
let action = '';
let direccion = 'listaPorNombre';
let contadorItems = 0;
let ids = [];

function cambiarPlaceHolder(mensaje) {
    document.getElementById('buscadorListadoProductos')['placeholder'] = mensaje;
    if (mensaje == 'Nombre producto') {
        direccion = 'listaPorNombre';


    } else if (mensaje == 'Nombre categoria') {
        direccion = 'listaPorCategoria';

    }

}


function ventas() {
    pagina = 0;
    action = "ventas?pagina=" + pagina;
    getProductos()


}


function puntuacion() {
    pagina = 0;
    action = "puntuacionProductos?pagina=" + pagina;
    getProductos()
    console.log('puntuacion');

}


function buscar(e) {
    e.preventDefault();
    e.stopPropagation();
    pagina = 0;
    let busqueda = document.getElementById('buscadorListadoProductos').value;
    console.log(busqueda);
    action = direccion + '?nombre=' + busqueda + "&pagina=" + pagina;

    getProductos()

}








async function getProductos() {



    const response = await fetch(action);

    info = await response.json();



    // json[pagina] = info;

    // let tbody = document.getElementById('bodyLista');
    // tbody.innerHTML = "";

    if (info[0] == 0) {
        return;
    }
    // info.forEach(element => {
    //     let tr = document.createElement("tr");
    //     let td = [];
    //     for (let i = 0; i < columnas.length-1; i++) {
    //         td[i] = document.createElement('td');
    //         td[i].textContent = element[columnas[i]];
    //     }

    //     tr.append(...td);


    //             tr.onclick=()=>{
    //                 location.href="admin/"+tabla+'/'+element['id'];


    //         }

    //     tbody.append(tr);
    // });


    console.log(info[0]['nombre']);
    console.log(info[0]['categoria']);
    console.log(info[0]['descripcion']);
    console.log(info[0]['precio']);
    console.log(info[0]['latitud']);
    console.log(info[0]['longitud']);
    console.log(info[0]['puntuacion_compra']);
    console.log(info[0]['puntuacion_comentarios']);
    console.log(info[0]['puntuacion_total']);
    console.log(info[0]['id']);

    let acordeon = document.getElementById('accordion-1');



    let vueltas = 0;
    ids = [];
    info.forEach(async element => {

        console.log('id ' + element['id']);
        let combo = { id: element['id'], nPag: 0 }
        ids.push(combo);
        let comentarioUsuario = await getComentario(element['id']);

        contadorItems++;
        let contenido = `<div class="accordion-item">
    <h2 class="accordion-header" role="tab">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-${contadorItems}" aria-expanded="false" aria-controls="accordion-1 .item-${contadorItems}">

        <div class="container-fluid row">
          <div class="col-3">
            <img class="" src="${"../vistas/galeria/objetos/" + element['id'] + "/img1/" + element['foto1']}" style="max-height: 60px" />

          </div>

          <div class="col-5">
            <h3>${element['nombre']}</h3>
          </div>
          <div class="col-4">
            <h5>Score: ${element['puntuacion_comentarios'] + element['puntuacion_compra']}</h5>
          </div>



        </div>
      </button>
    </h2>
    <div class="accordion-collapse collapse item-${contadorItems}" role="tabpanel" data-bs-parent="#accordion-1">



      <!-- body -->
      <div class="accordion-body mb-4">

        <div class="container py-4 py-xl-5">

          <div class="row row-cols-1 row-cols-md-2">
            <div class="col">
              <div class="row">

                <div class="col-12">
                  <img class="rounded w-100 h-100 fit-cover" style="min-height: 300px" src="${"../vistas/galeria/objetos/" + element['id'] + "/img1/" + element['foto1']}" />
                </div>
                <div class="col-12">
                  <button>
                    <img class="" src="${"../vistas/galeria/objetos/" + element['id'] + "/img1/" + element['foto1']}" style="max-height: 60px" />

                  </button>
                  <button>
                    <img class="" src="${"../vistas/galeria/objetos/" + element['id'] + "/img2/" + element['foto2']}" style="max-height: 60px" />

                  </button>
                  <button>
                    <img class="" src="${"../vistas/galeria/objetos/" + element['id'] + "/img3/" + element['foto3']}" style="max-height: 60px" />

                  </button>
                </div>

              </div>





            </div>
            <div class="col d-flex flex-column justify-content-center p-4">
              <div class="text-center text-md-start d-flex flex-column align-items-center align-items-md-start mb-5">

                <div>
                  <h4>${element['nombre']}</h4>
                  <p>
                   ${element['descripcion']}
                  </p>
                  <h4>${element['precio']}€</h4>
                  <button class="btn btn-primary" type="button">Comprar Ya</button>
                </div>

              </div>


            </div>




          </div>

          <div class="row">
            <div class="col-12 d-flex flex-column justify-content-center p-4">
              <h2>Reseñas</h2>
              <div class="mb-3">
                <label for="exampleFormControlTextarea1${element['id']}" class="form-label">Comenta este Producto</label>
                <textarea class="form-control" id="exampleFormControlTextarea1${element['id']}" rows="3" >${comentarioUsuario}</textarea>
                <div class=" justify-content-center w-100" role="group" aria-label="Basic outlined example">
                  <button type="button" class="btn btn-outline-primary" onclick="comentar(${element['id']})" >Comentar</button>
                  <button type="button" class="btn btn-outline-primary" onclick="actualizar(${element['id']})" >Actualizar</button>
                  <button type="button" class="btn btn-outline-primary" onclick="eliminar(${element['id']})" >Eliminar</button>
                </div>
              </div>
            </div>
          </div>

          <div class="container py-4 py-xl-5">
            <div class="row mb-5">
              <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>Reseñas de otros clientes</h2>
              </div>
            </div>
            <div class="row gy-4 row-cols-1 row-cols-sm-2 row-cols-lg-3" id="comentariosOtrosUsuarios${element['id']}">
              
              


            </div>

            <div class="row mb-5 mt-5">
              <div class="col-md-8 col-xl-6 text-center mx-auto">
              <p id="pag${element['id']}"  >0</p>
                <button type="button" class="btn btn-primary" onclick="getComentarios(${element['id']})" >Mostrar más</button>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>

  </div>`;


        if (pagina == 0 && vueltas == 0) {
            acordeon.innerHTML = contenido
            vueltas++;
        } else {
            acordeon.innerHTML += contenido;

        }

    });


    await getComentarios();




}

function cargarMas() {

    pagina++;
    action = action.replace("pagina=" + (pagina - 1) + "", "pagina=" + pagina);
    getProductos();
}




function comentar(id) {
    console.log(id);
    //mostrar fecha con formato aaaa-mm-dd
    let fecha = new Date();
    let dia = fecha.getDate();
    let mes = fecha.getMonth() + 1;
    let anio = fecha.getFullYear();
    let fechaActual = anio + "-" + mes + "-" + dia;
    let comentario = document.getElementById("exampleFormControlTextarea1" + id).value;
    console.log(fechaActual);

    setComentario(id, fechaActual, comentario);



}
async function actualizar(id) {
    let comentario = document.getElementById("exampleFormControlTextarea1" + id).value;
    const response = await fetch("actualizarComentarioUsuario?idObjeto=" + id + "&comentario=" + comentario);
    info = await response.json();

}
async function eliminar(id) {
    const response = await fetch("deleteComentarioUsuario?idObjeto=" + id);
    info = await response.json();
}



async function getComentarios(id) {

    if (id == undefined) {




        for (let i = 0; i < ids.length; i++) {

            // let pag = document.getElementById("pag" + ids[i]);

            // pag.textContent = parseInt(pag.textContent) + 1;
            const response = await fetch("getComentariosProducto?idObjeto=" + ids[i].id + "&pagina=" + ids[i].nPag);
            let info2 = await response.json();
            info2.forEach(element => {
                let row = document.getElementById("comentariosOtrosUsuarios" + ids[i].id);
                console.log("info2", element);
                let div = document.createElement("div");
                div.className = "col";
                let p = document.createElement("p");
                p.className = "bg-light border rounded border-0 border-light p-4";
                p.textContent = element['comentario'];

                div.appendChild(p);
                row.appendChild(div);




            });

            ids[i].nPag++;
        }
    } else {

        for (let i = 0; i < ids.length; i++) {

            if (ids[i].id == id) {



                const response = await fetch("getComentariosProducto?idObjeto=" + ids[i].id + "&pagina=" + ids[i].nPag);
                let info2 = await response.json();
                
                if(info2==0){return}
                info2.forEach(element => {
                    let row = document.getElementById("comentariosOtrosUsuarios" + ids[i].id);
                    console.log("info2", element);
                    let div = document.createElement("div");
                    div.className = "col";
                    let p = document.createElement("p");
                    p.className = "bg-light border rounded border-0 border-light p-4";
                    p.textContent = element['comentario'];

                    div.appendChild(p);
                    row.appendChild(div);




                });

                ids[i].nPag++;
                return;
            }
        }

    }


}

async function getComentario(id) {
    const response = await fetch("getComentarioUsuario?idObjeto=" + id);
    let info = await response.json();
    if (info[0]['comentario'] == undefined) {
        return "";
    }
    return info[0]['comentario'];
}

async function setComentario(id, fecha, comentario) {
    const response = await fetch("setComentarioUsuario?idObjeto=" + id + "&comentario=" + comentario + "&fecha=" + fecha);
    info = await response.json();


}


