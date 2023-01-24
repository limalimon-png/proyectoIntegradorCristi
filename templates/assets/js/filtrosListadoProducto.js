let pagina = 0;
let action='';
let direccion='listaPorNombre';
/*
listaPorNombre
listaPorCategoria
ventas
puntuacion
*/

function cambiarPlaceHolder(mensaje){
    document.getElementById('buscadorListadoProductos')['placeholder']=mensaje;
    if(mensaje=='Nombre producto'){
        direccion='listaPorNombre';
        
        
    }else if(mensaje=='Nombre categoria'){
        direccion='listaPorCategoria';

    }

}


function ventas(){
    pagina=0;
    action="ventas?pagina="+pagina;
    getProductos()


}


function puntuacion(){
    pagina=0;
    action="puntuacionProductos?pagina="+pagina;
    getProductos()
    console.log('puntuacion');

}


function buscar(e){
    e.preventDefault();
    e.stopPropagation();
    pagina=0;
    let busqueda=document.getElementById('buscadorListadoProductos').value;
    console.log(busqueda);
     action=direccion+'?nombre='+busqueda+"&pagina="+pagina;
     
     getProductos()
    
}

async function getProductos() {
   
    

        const response = await fetch(action);

        info = await response.json();
   
      

        // json[pagina] = info;
    
    // let tbody = document.getElementById('bodyLista');
    // tbody.innerHTML = "";

console.log(info);
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


}

function cargarMas(){
    pagina++;
    getProductos();
}