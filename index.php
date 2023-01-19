<?php

//Incluyo los archivos necesarios

require("model/sesiones.php");
require("model/añadir.php");
require "model/bd.php";
require "model/cabecera.php";
require "model/logout.php";
require "model/eliminar.php";
require "model/procesar_pedido.php";
require "model/comprobarReseteo.php";
require "model/actualizarUsuario.php";
require "model/actualizarObjeto.php";
require "model/actualizarCategoria.php";


require("./controller/controller.php");
require("composer/mailer.php");


//Instancio el controlador
$controller = new Controller;

//Ruta de la home
$home = "/proyecto2eva/proyecto/index.php/";
//Quito la home de la ruta de la barra de direcciones
$ruta = str_replace($home, "", $_SERVER["REQUEST_URI"]);

//Creo el array de ruta (filtrando los vacíos)
$array_ruta = array_filter(explode("/", $ruta));




//Decido la ruta en función de los elementos del array
if (isset($array_ruta[0]) && $array_ruta[0] == "login" && !isset($array_ruta[1])){   
    //Llamo al método ver pasándole la clave que me están pidiendo
    // $controller->login();

}else if(isset($array_ruta[0]) && $array_ruta[0] == "admin" && isset($array_ruta[1]) && $array_ruta[1] == "login" &&   !isset($array_ruta[2])){   
        
        // $controller->productos($array_ruta[1]);
        $controller->login();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "admin" && isset($array_ruta[1]) && $array_ruta[1] == "forget" &&   !isset($array_ruta[2])){   
        
        // $controller->productos($array_ruta[1]);
        $controller->forgetAdmin();
     
    
        //ira carrito
   
}else if (isset($array_ruta[0]) && $array_ruta[0] == "registro" && !isset($array_ruta[1])){   
    //Llamo al método ver pasándole la clave que me están pidiendo
    $controller->registro();
}else if (isset($array_ruta[0]) && $array_ruta[0] == "registro" && $array_ruta[1] == "process" ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
    $controller->registroProcess();
}else if (isset($array_ruta[0]) && $array_ruta[0] == "admin" && isset($array_ruta[1]) && $array_ruta[1] == "login" &&   isset($array_ruta[2])  && $array_ruta[2] == "process" &&   !isset($array_ruta[3]) ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
    $controller->autentication();
}else if (isset($array_ruta[0]) && $array_ruta[0] == "admin" && isset($array_ruta[1]) && $array_ruta[1] == "control"  && !isset($array_ruta[2]) ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
    $controller->panelControl();


}else if (isset($array_ruta[0]) && $array_ruta[0] == "admin" &&preg_match("/^(productos||categorias||usuarios||comentarios)$/",$array_ruta[1])==1  && !isset($array_ruta[2]) ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
    $controller->tabla('tables-data.php');
}else if (isset($array_ruta[0])  &&preg_match("/^lista\?tabla=(productos||categorias||usuarios||comentarios)&pagina=\d+$/",$array_ruta[0])==1 && !isset($array_ruta[1])  ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
  
    echo $controller->listaProductos();
   
   
    
}else if (isset($array_ruta[0]) && $array_ruta[0] == "admin" && isset($array_ruta[1]) && $array_ruta[1] == "usuarios" && preg_match("/^\d+$/",$array_ruta[2])==1 && !isset($array_ruta[3])  ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
  
    $controller->verFicha('Usuario');
   
}else if (isset($array_ruta[0]) && $array_ruta[0] == "admin" && isset($array_ruta[1]) && $array_ruta[1] == "categorias" && preg_match("/^\d+$/",$array_ruta[2])==1 && !isset($array_ruta[3])  ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
  
    $controller->verFicha('Categoria');

}else if (isset($array_ruta[0]) && $array_ruta[0] == "admin" && isset($array_ruta[1]) && $array_ruta[1] == "productos" && preg_match("/^\d+$/",$array_ruta[2])==1 && !isset($array_ruta[3])  ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
  
    $controller->verFicha('Objeto');

}else if (isset($array_ruta[0]) && $array_ruta[0] == "admin" && isset($array_ruta[1]) && $array_ruta[1] == "comentarios" && preg_match("/^\d+_\d+$/",$array_ruta[2])==1 && !isset($array_ruta[3])  ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
  
    $controller->verFicha('Comentarios');
    
    

}else if (isset($array_ruta[0])  &&preg_match("/^infousuario\?id=\d+$/",$array_ruta[0])==1 && !isset($array_ruta[1])  ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
  
    echo $controller->infoUsuario();
}else if (isset($array_ruta[0])  &&preg_match("/^infocategoria\?id=\d+$/",$array_ruta[0])==1 && !isset($array_ruta[1])  ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
  
    echo $controller->infoCategoria();
}else if (isset($array_ruta[0])  &&preg_match("/^infoproducto\?id=\d+$/",$array_ruta[0])==1 && !isset($array_ruta[1])  ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
  
    echo $controller->infoProducto();
}else if (isset($array_ruta[0])  &&preg_match("/^infocomentario\?idU=\d+&idO=\d+$/",$array_ruta[0])==1 && !isset($array_ruta[1])  ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
  
    echo $controller->infoComentario();
   
}else if (isset($array_ruta[0]) && $array_ruta[0] == "admin" && isset($array_ruta[1]) && $array_ruta[1] == "usuarios" && preg_match("/^\d+$/",$array_ruta[2])==1 && isset($array_ruta[3]) && $array_ruta[3]=='process' && !isset($array_ruta[4]) ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
  
    $controller->actualizarUsuario();


}else if (isset($array_ruta[0]) && $array_ruta[0] == "admin" && isset($array_ruta[1]) && $array_ruta[1] == "usuarios" && preg_match("/^\d+$/",$array_ruta[2])==1 && isset($array_ruta[3]) && $array_ruta[3]=='process' && !isset($array_ruta[4]) ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
  
    // echo $controller->eliminarUsuario();

    
}else if (isset($array_ruta[0]) && $array_ruta[0] == "admin" && isset($array_ruta[1]) && $array_ruta[1] == "usuarios"&& isset($array_ruta[2]) && $array_ruta[2]=='nuevo' && !isset($array_ruta[3]) ){   
$controller->nuevoUsuario();




}else if (isset($array_ruta[0]) && $array_ruta[0] == "admin" && isset($array_ruta[1]) && $array_ruta[1] == "productos"&& isset($array_ruta[2]) && $array_ruta[2]=='actualizar' && !isset($array_ruta[3]) ){   
$controller->actualizarProducto();
}else if (isset($array_ruta[0]) && $array_ruta[0] == "admin" && isset($array_ruta[1]) && $array_ruta[1] == "comentarios"&& isset($array_ruta[2]) && $array_ruta[2]=='actualizar' && !isset($array_ruta[3]) ){   
$controller->actualizarComentario();
}else if (isset($array_ruta[0]) && $array_ruta[0] == "admin" && isset($array_ruta[1]) && $array_ruta[1] == "categorias"&& isset($array_ruta[2]) && $array_ruta[2]=='actualizar' && !isset($array_ruta[3]) ){   
    $controller->actualizarCategoria();
    














    
// }else if (isset($array_ruta[0]) && $array_ruta[0] == "categorias" && !isset($array_ruta[1]) ){   
//     //Llamo al método ver pasándole la clave que me están pidiendo
//     $controller->categorias();
   
}else if(isset($array_ruta[0]) && $array_ruta[0] == "categorias" && isset($array_ruta[1])&& preg_match("/^.+$/", $array_ruta[1])==1   ){   
    //Llamo al método ver pasándole la clave que me están pidiendo}else if (isset($array_ruta[0]) && $array_ruta[0] ==
    $controller->productos($array_ruta[1]);
 


   
}else{
    //Llamo al método por defecto del controlador
   

    //    $controller->porDefecto();


       var_dump($array_ruta);
}

?>