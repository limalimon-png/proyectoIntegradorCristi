let id;
let url=location.href;


window.onload=async ()=>{
    id = location.href.substring(location.href.lastIndexOf("/") + 1);

    document.getElementById('img').addEventListener('change', (e) => {
        const original = e.target.files[0];
        document.getElementById("img-preview").src=URL.createObjectURL(original);
    });

    if(id!='nuevo'){

        await getProductos()
    }
 


}




async function getProductos() {
   
  

        const response = await fetch('infousuario?id='+id);

        info = await response.json();

        

      
 
   
    document.getElementById('img-preview').src="../vistas/galeria/usuarios/"+id+"/"+info[0][0];
    document.getElementById('id-preview').value=info[0][1];
    document.getElementById('id').value=info[0][1];
    document.getElementById('nombre').value=info[0][2];
    document.getElementById('apellidos').value=info[0][3];
    document.getElementById('email').value=info[0][4];
    document.getElementById('pass').value=info[0][5];
    document.getElementById('monedero').value=info[0][6];



   

}


function volver(){


    location.href=url.substring(0,url.lastIndexOf("/"))
}


async function eliminar(){
    
    location.href='admin/usuarios/eliminarUsuario?id='+id;

    

}

function nuevo(){

    location.href=url.substring(0,url.lastIndexOf("/"))+'/nuevo'
}