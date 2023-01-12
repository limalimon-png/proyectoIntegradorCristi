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

}else if (isset($array_ruta[0]) && $array_ruta[0] == "admin" && isset($array_ruta[1]) && $array_ruta[1] == "productos"  && !isset($array_ruta[2]) ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
    $controller->tabla('tables-data.php');
}else if (isset($array_ruta[0]) && $array_ruta[0] == "admin" && isset($array_ruta[1]) && $array_ruta[1] == "categorias"  && !isset($array_ruta[2]) ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
    $controller->tabla('tablaCategorias.php');
}else if (isset($array_ruta[0]) && $array_ruta[0] == "admin" && isset($array_ruta[1]) && $array_ruta[1] == "usuarios"  && !isset($array_ruta[2]) ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
    $controller->tabla('tablaUsuarios.php');
}else if (isset($array_ruta[0]) && $array_ruta[0] == "lista?tabla=productos" && !isset($array_ruta[1])  ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
    echo $controller->listaProductos();
    












    
}else if (isset($array_ruta[0]) && $array_ruta[0] == "categorias" && !isset($array_ruta[1]) ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
    $controller->categorias();
   
}else if(isset($array_ruta[0]) && $array_ruta[0] == "categorias" && isset($array_ruta[1])&& preg_match("/^.+$/", $array_ruta[1])==1   ){   
    //Llamo al método ver pasándole la clave que me están pidiendo}else if (isset($array_ruta[0]) && $array_ruta[0] ==
    $controller->productos($array_ruta[1]);
 

    //ira carrito
}else if (isset($array_ruta[0]) && $array_ruta[0] == "carrito" && !isset($array_ruta[1])){   

    $controller->verCarrito();
}else if (isset($array_ruta[0]) && $array_ruta[0] == "carrito" && $array_ruta[1] == "agregar" ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
    $controller->agregarProducto();
}else if (isset($array_ruta[0]) && $array_ruta[0] == "carrito" && $array_ruta[1] == "actualizar" ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
    $controller->actualizarProducto();

}else if (isset($array_ruta[0]) && $array_ruta[0] == "pedido" && !isset($array_ruta[1]) ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
    $controller->procesarPedido();
   
}else if (isset($array_ruta[0]) && $array_ruta[0] == "admin" && isset($array_ruta[1])  && $array_ruta[1] == "logout" && !isset($array_ruta[2]) ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
    $controller->cerrarSesion();
    // $controller->login();

}else if (isset($array_ruta[0]) && $array_ruta[0] == "password" && isset($array_ruta[1]) && $array_ruta[1]=="recordar" &&isset($array_ruta[2]) && $array_ruta[2] =="formulario" && !isset($array_ruta[3]) ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
    $controller->resetearFormulario();
    
}else if (isset($array_ruta[0]) && $array_ruta[0] == "password" && isset($array_ruta[1]) && $array_ruta[1]=="recordar" &&isset($array_ruta[2]) && $array_ruta[2] =="enviaremail" && !isset($array_ruta[3]) ){   
    //Llamo al método ver pasándole la clave que me están pidiendo
    $controller->enviarMail();
    
}else if (isset($array_ruta[0]) && $array_ruta[0] == "password" && isset($array_ruta[1]) && $array_ruta[1]=="regenerar" &&isset($array_ruta[2]) &&preg_match("/^formulario.+$/", $array_ruta[2])==1 ){   
    //formulario para escribir la contraseña 
    $controller->formularioPass();
}else if (isset($array_ruta[0]) && $array_ruta[0] == "password" && isset($array_ruta[1]) && $array_ruta[1]=="regenerar" &&isset($array_ruta[2]) && $array_ruta[2] =="formulario" && isset($array_ruta[3]) && $array_ruta[3] =="process"){   
    //procerso donde comprobamos que existe en la tabla antes de modificar
    $controller->comprobar();
    

   
}else{
    //Llamo al método por defecto del controlador
   

    //    $controller->porDefecto();


       var_dump($array_ruta);
}

?>