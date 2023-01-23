


function cambiarPlaceHolder(mensaje){
    document.getElementById('buscadorListadoProductos')['placeholder']=mensaje;
    if(mensaje=='Nombre producto'){
        document.getElementById('formularioProductos')['action']='listaPorNombre';
        
        
    }else if(mensaje=='Nombre categoria'){
        document.getElementById('formularioProductos')['action']='listaPorCategoria';

    }

}


function ventas(){
    

}


function puntuacion(){
    

}