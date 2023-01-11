<?php 

class Agregar{
    function __construct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST["unidades"]) &&isset($_POST["cod"])) {
                if (!empty($_POST["unidades"] && !empty($_POST["cod"]))) {
                  $cod=$_POST["cod"];
                  $unidades=$_POST["unidades"];
                   session_start();
                   if(isset($_SESSION["carrito"])){
                    $carrito=$_SESSION["carrito"];
                    if (isset($carrito[$_POST["cod"]])){
                        $carrito[$cod]=$carrito[$cod]+$unidades;
                        $_SESSION["carrito"]=$carrito;
                        $cat = $_POST["cat"];
                       
                         header('location:../categorias/'.$cat);
                    }else{
                        $carrito[$_POST["cod"]]=$_POST["unidades"];
                        $_SESSION["carrito"]=$carrito;
                        $cat = $_POST["cat"];
                        header('location:../categorias/'.$cat);
                    }
                   
                 
              
        
                   }else{
                    $datos[$_POST["cod"]]=$_POST["unidades"];
                    $_SESSION["carrito"]=$datos;
                    $cat = $_POST["cat"];
                    header('location:../categorias/'.$cat);
                }
                   
        
                
        
        
        
                }
        
              
        
        
                
            } else {
                $cat = $_POST["cat"];
                header('location:productos.php?cat='.$cat);
                
            }
        }
    }
}



?>