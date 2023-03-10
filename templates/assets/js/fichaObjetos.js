let id;
let url=location.href;
let idCat;


window.onload=async ()=>{
    id = location.href.substring(location.href.lastIndexOf("/") + 1);

    document.getElementById('img').addEventListener('change', (e) => {
        const original = e.target.files[0];
        document.getElementById("img-preview1").src=URL.createObjectURL(original);
    });
    document.getElementById('img2').addEventListener('change', (e) => {
        const original = e.target.files[0];
        document.getElementById("img-preview2").src=URL.createObjectURL(original);
    });
    document.getElementById('img3').addEventListener('change', (e) => {
        const original = e.target.files[0];
        document.getElementById("img-preview3").src=URL.createObjectURL(original);
    });

    if(id!='nuevo'){

        await getProductos()
    }
        await getCategorias();
    
    


}




async function getProductos() {
   
  

        const response = await fetch('infoproducto?id='+id);

        info = await response.json();

        

    
 
   if(info[0]['foto1']==0||info[0]['foto1']==undefined||info[0]['foto1']==null){
   }else{
       document.getElementById('img-preview1').src="../vistas/galeria/objetos/"+id+"/img1/"+info[0]['foto1'];

   }
   if(info[0]['foto2']==0||info[0]['foto2']==undefined||info[0]['foto2']==null){
   }else{
       document.getElementById('img-preview2').src="../vistas/galeria/objetos/"+id+"/img2/"+info[0]['foto2'];

   }
   if(info[0]['foto3']==0||info[0]['foto3']==undefined||info[0]['foto3']==null){
   }else{
       document.getElementById('img-preview3').src="../vistas/galeria/objetos/"+id+"/img3/"+info[0]['foto3'];

   }
   idCat=info[0]['categoria'];
    document.getElementById('id-preview').value=info[0]['id'];
    document.getElementById('id').value=info[0]['id'];
    document.getElementById('categoria').value=info[0]['categoria'];
    document.getElementById('nombre').value=info[0]['nombre'];
    document.getElementById('descripcion').value=info[0]['descripcion'];
    document.getElementById('precio').value=info[0]['precio'];
    document.getElementById('latitud').value=info[0]['latitud'];
    document.getElementById('longitud').value=info[0]['longitud'];
    document.getElementById('puntuacion_compra').value=info[0]['puntuacion_compra'];
    document.getElementById('puntuacion_comentarios').value=info[0]['puntuacion_comentarios'];
    document.getElementById('puntuacion_total').value=info[0]['puntuacion_total'];



    cargarDesdeOtroArchivo();

}


function volver(){

    let url=location.href;
    location.href=url.substring(0,url.lastIndexOf("/"))
}


async function eliminar(){
    
    location.href='eliminarProducto?id='+id;

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
        document.getElementById('categoria').append(option);
        
        
    });

}