<?php 
class Cabecera{

   
    public static function menuCategorias(){
        
        if(session_status()!=2)
            session_start();
        
       
       $usuario= $_SESSION['credenciales'];
        $string= "<p>Usuario: $usuario[0] </p><a href='./categorias'>Home</a>
        <a href='./carrito'>Ver carrito</a>
        <a href='./logout'>Cerrar Sesion</a>";
        return $string;

    }

    public static function menuProductos(){
        
        if(session_status()!=2)
            session_start();
        
       
       $usuario= $_SESSION['credenciales'];
        $string= "<p>Usuario: $usuario[0] </p><a href='../categorias'>Home</a>
        <a href='../carrito'>Ver carrito</a>
        <a href='../logout'>Cerrar Sesion</a>";
        return $string;

    }

    public static function menuCarrito(){
        
        if(session_status()!=2)
            session_start();
        
       
       $usuario= $_SESSION['credenciales'];
        $string= "<p>Usuario: $usuario[0] </p><a href='./categorias'>Home</a>
        <a href='../carrito'>Ver carrito</a>
        <a href='./logout'>Cerrar Sesion</a>";
        return $string;

    }


    public static function control()
    {
        if(session_status()!=2)
            session_start();
        if (isset($_SESSION["credenciales"])) {
            if (empty($_SESSION["credenciales"])) {
                header('location:login');
             return false;
            } else {
              return true;
            }
            
        } else {
            header('location:login');
            return false;
           
        }

        
    }
}

?>
