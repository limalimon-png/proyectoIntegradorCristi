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
   
  

        const response = await fetch('infoproducto?id='+id);

        info = await response.json();

        

        $producto = [];
        $producto['nombre'] = $res[0];
        $producto['categoria'] = $res[1];
        $producto['descripcion'] = $res[2];
        $producto['precio'] = $res[3];
        $producto['latitud'] = $res[4];
        $producto['longitud'] = $res[5];
        $producto['puntuacion_compra'] = $res[6];
        $producto['puntuacion_comentarios'] = $res[7];
        $producto['puntuacion_total'] = $res[8];
        $producto['id'] = $res[9];
        $producto['foto1'] = $res[10];
        $producto['foto2'] = $res[11];
        $producto['foto3'] = $res[12];
 
   
    document.getElementById('img-preview1').src="../vistas/galeria/objetos/"+id+"/"+info[0]['foto1'];
    document.getElementById('img-preview2').src="../vistas/galeria/objetos/"+id+"/"+info[0]['foto2'];
    document.getElementById('img-preview3').src="../vistas/galeria/objetos/"+id+"/"+info[0]['foto3'];
    document.getElementById('id-preview').value=info[0][1];
    document.getElementById('id').value=info[0][1];
    document.getElementById('nombre').value=info[0][2];
    document.getElementById('descripcion').value=info[0][3];
    document.getElementById('precio').value=info[0][4];
    document.getElementById('latitud').value=info[0][5];
    document.getElementById('longitud').value=info[0][6];
    document.getElementById('puntuacion_compra').value=info[0][5];
    document.getElementById('puntuacion_comentarios').value=info[0][6];
    document.getElementById('puntuacion_total').value=info[0][6];



   

}


function volver(){

    let url=location.href;
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