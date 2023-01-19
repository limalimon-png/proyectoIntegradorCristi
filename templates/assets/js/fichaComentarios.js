let id,idO;
let url=location.href;


window.onload=async ()=>{
    id = location.href.substring(location.href.lastIndexOf("/") + 1);
    idO=id.substring(id.lastIndexOf("_")+1)
    id=id.substring(0,id.lastIndexOf("_"))


    

    // document.getElementById('img').addEventListener('change', (e) => {
    //     const original = e.target.files[0];
    //     document.getElementById("img-preview").src=URL.createObjectURL(original);
    // });

    await getProductos()


}




async function getProductos() {
   
  

        const response = await fetch('infocomentario?idU='+id+"&idO="+idO);

        info = await response.json();

    

      
        // let id=info[0]['id'];
        // let idO= id.substring(id.lastIndexOf("_")+1)
        // id=id.substring(0,id.lastIndexOf("_"))
   
    document.getElementById('idUsuario-preview').value=info[0]['email usuario'];
    document.getElementById('idObjeto-preview').value=info[0]['nombre usuario'];
    document.getElementById('idUsuario').value=id
    document.getElementById('idObjeto').value=idO
    document.getElementById('fecha').value=info[0]['fecha'];
    document.getElementById('comentario').value=info[0]['comentario'];
    



   

}


function volver(){


    location.href=url.substring(0,url.lastIndexOf("/"))
}


async function eliminar(){
    
    const response = await fetch('eliminarUsuario?id='+id);

    let info = await response.json();
    console.log(info);

}

function nuevo(){

    location.href=url.substring(0,url.lastIndexOf("/"))+'/nuevo'
}