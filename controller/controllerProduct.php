<?php


use mail\Mailer;

class ControllerProductos
{
   
    






    public function listaProductos()
    {

        $pagina = 0;
        if (isset($_GET['tabla'])) {
            $tabla = $_GET['tabla'];

            if (isset($_GET['pagina'])) {
                $pagina = $_GET['pagina'];
            }

            $bd = new Bd();
            return (json_encode($bd->getLista($pagina, $tabla)));
        } else {
            return "no llega nada";
        }
    }
 public function infoProducto()
    {


        if (isset($_GET['id'])) {
            $id = $_GET['id'];



            $bd = new Bd();
            return (json_encode($bd->getProducto($id)));
        } else {
            return "no llega nada";
        }
    }
 public function infoProductos()
    {

        $bd = new Bd();
        return json_encode($bd->getProductosSelect());
    }
 public function irAltaProducto()
    {



        require('vistas/altaObjeto.php');
    }
 public function nuevoProducto()
    {

       
        $act = new ActualizarObj();
        $act->llegan_datos();


        require('vistas/altaObjeto.php');
    }
 public function actualizarProducto()
    {
        $act = new ActualizarObj();
        $act->actualizar();
    }
 public function deleteProducto()
    {
        if (isset($_GET['id'])) {
            $datos = [];
            $datos[0] = $_GET['id'];


            $bd = new Bd();
            $mensaje = $bd->deleteProducto($datos);
            if ($mensaje != "No se pudo eliminar") {
                header('location:../productos');
           
            } 
        }
    }



    
    }
