let id;
let url=location.href;
let idCat;


window.onload=async ()=>{
    id = location.href.substring(location.href.lastIndexOf("/") + 1);

    document.getElementById('img').addEventListener('change', (e) => {
        const original = e.target.files[0];
        document.getElementById("img-preview").src=URL.createObjectURL(original);
    });
if(id!='nuevo'){

    await getProductos()
}
    await getCategorias();


    cargarDesdeOtroArchivo();


}




async function getProductos() {
   
  

        const response = await fetch('infocategoria?id='+id);

        info = await response.json();

       // console.log(info);

     if(info[0]['foto']==0 || info[0]['foto']==undefined){

         document.getElementById('img-preview').src="../templates/images/noImage.png";
        }else{
         document.getElementById('img-preview').src="../vistas/galeria/categorias/"+id+"/"+info[0]['foto'] 

     }

     idCat=info[0]['titulo categoria padre'];
   
    document.getElementById('id-preview').value=info[0]['id'];
    document.getElementById('id').value=info[0]['id'];
    // document.getElementById('categoria_padre').value=info[0]['titulo categoria padre'];
    document.getElementById('titulo').value=info[0]['titulo'];
    document.getElementById('descripcion').value=info[0]['descripcion'];
    // document.getElementById('puntuacion').value=info[0][5];



   

}


function volver(){


    location.href=url.substring(0,url.lastIndexOf("/"))
}


async function eliminar(){
    
    // const response = await fetch('eliminarUsuario?id='+id);

    // let info = await response.json();
    // console.log(info);

}

function nuevo(){

    location.href=url.substring(0,url.lastIndexOf("/"))+'/nuevo'
}



async function getCategorias(){
    const response = await fetch('selectCategorias');

    info = await response.json();
    

    info.forEach(element => {
      
        let option =document.createElement("option");
        option.value=element['id'];
        option.append(element['titulo']);
        if(element['titulo']==idCat){
            option.selected=true;
        }
        document.getElementById('categoria_padre').append(option);
        
        
    });

}


async function eliminar(){
    
    location.href='eliminarCategoria?id='+id;

}