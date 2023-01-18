let id;
let url=location.href;


window.onload=async ()=>{
    id = location.href.substring(location.href.lastIndexOf("/") + 1);

    document.getElementById('img').addEventListener('change', (e) => {
        const original = e.target.files[0];
        document.getElementById("img-preview").src=URL.createObjectURL(original);
    });

    await getProductos()


}




async function getProductos() {
   
  

        const response = await fetch('infocategoria?id='+id);

        info = await response.json();

        console.log(info);

     if(info[0]['foto']==0 || info[0]['foto']==undefined){

         document.getElementById('img-preview').src="../templates/images/noImage.png";
        }else{
         document.getElementById('img-preview').src="../vistas/galeria/categorias/"+id+"/"+info[0]['foto'] 

     }


   
    document.getElementById('id-preview').value=info[0]['id'];
    document.getElementById('id').value=info[0]['id'];
    document.getElementById('categoria_padre').value=info[0]['titulo categoria padre'];
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