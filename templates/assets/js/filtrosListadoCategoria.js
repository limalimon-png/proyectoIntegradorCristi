let pagina = 0;
let action = '';
let direccion = 'listaPorTitulo';
let contadorItems = 0;
let ids = [];

function cambiarPlaceHolder(mensaje) {
  document.getElementById('buscadorListadoCategorias')['placeholder'] = mensaje;
  if (mensaje == 'Nombre categoria') {
    direccion = 'listaPorTitulo';


  } else if (mensaje == 'Descripcion categoria') {
    direccion = 'listaPorDescripcion';

  }

}


function ventas() {
  pagina = 0;
  action = "ventas?pagina=" + pagina;
  getCategorias()


}


function puntuacion() {
  pagina = 0;
  action = "puntuacionCategorias?pagina=" + pagina;
  getCategorias()
  //console.log('puntuacion');

}


function buscarCategoria(e) {
  e.preventDefault();
  e.stopPropagation();
  pagina = 0;
  let busqueda = document.getElementById('buscadorListadoCategorias').value;
  action = direccion + '?nombre=' + busqueda + "&pagina=" + pagina;

  if(busqueda==''){}else{
    getCategorias()}



}






async function getProductos(nombre,id) {



  const response = await fetch('listaPorCategoria?nombre=' + nombre + '&pagina=0');

  let info3 = await response.json();



  // json[pagina] = info;

  // let tbody = document.getElementById('bodyLista');
  // tbody.innerHTML = "";

  if (info3[0] == 0) {
    return;
  }




  let acordeon = document.getElementById('accordion-'+id+"-hijo");



  let vueltas = 0;

  info3.forEach(async element => {







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



    

  </div>

</div>`;


    if (pagina == 0 && vueltas == 0) {
      acordeon.innerHTML = contenido
      vueltas++;
    } else {
      acordeon.innerHTML += contenido;

    }

  });


  // await getComentarios();




}

async function getCategorias() {



  const response = await fetch(action);

  let info = await response.json();





  if (info[0] == 0) {
    return;
  }





  let acordeon = document.getElementById('accordion-2');

  //console.log(info);

  let vueltas = 0;

  info.forEach(async element => {
    
  if(element['foto']==null){
    element['foto']='../vistas/galeria/noImage.png';
  }else{
    element['foto']= "../vistas/galeria/categorias/" + element['id'] + "/" + element['foto']
  }

    // //console.log('id ' + element['id']);
    // let combo = { id: element['id'], nPag: 0 }
    // ids.push(combo);
    // let comentarioUsuario = await getComentario(element['id']);

    contadorItems++;
    let contenido = `<div class="accordion-item">
    <h2 class="accordion-header" role="tab">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-2 .item-${contadorItems}" aria-expanded="false" aria-controls="accordion-2 .item-${contadorItems}">

        <div class="container-fluid row">
          <div class="col-3">
            <img class="" alt='imagen' src="${  element['foto']}" style="max-height: 60px" />

          </div>

          <div class="col-5">
            <h3>${element['titulo']}</h3>
          </div>
          <div class="col-4">
            <h5>Score: ${element['puntuacion']}</h5>
          </div>



        </div>
      </button>
    </h2>
    <div class="accordion-collapse collapse item-${contadorItems}" role="tabpanel" data-bs-parent="#accordion-2">



      <!-- body -->
      <div class="mx-auto container" style="height: 100px;">
  </div>
  <div class="accordion container" role="tablist" id="accordion-${element['id']}-hijo">

  </div>

  <div id="cargarMas" class="mt-3 container" style="text-align: end;">
    <button type="button" class="btn btn-primary" onclick="cargarMas()">Cargar mas</button>
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
    try {
      
      await getProductos(element['titulo'], element['id']);
    } catch (error) {
      
    }
  });


  //  await getComentarios();




}

function cargarMas() {

  pagina++;
  action = action.replace("pagina=" + (pagina - 1) + "", "pagina=" + pagina);
  getCategorias();
}




function comentar(id) {
  //console.log(id);
  //mostrar fecha con formato aaaa-mm-dd
  let fecha = new Date();
  let dia = fecha.getDate();
  let mes = fecha.getMonth() + 1;
  let anio = fecha.getFullYear();
  let fechaActual = anio + "-" + mes + "-" + dia;
  let comentario = document.getElementById("exampleFormControlTextarea1" + id).value;
  //console.log(fechaActual);

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
        //console.log("info2", element);
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

        if (info2 == 0) { return }
        info2.forEach(element => {
          let row = document.getElementById("comentariosOtrosUsuarios" + ids[i].id);
          //console.log("info2", element);
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


