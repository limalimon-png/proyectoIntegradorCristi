<?php


use mail\Mailer;

class ControllerCategorias
{
  

    

    public function infoCategoria()
    {

        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];



            $bd = new Bd();
            return (json_encode($bd->getCategoria($id)));
        } else {
            return "no llega nada";
        }
    }
    public function infoCategorias()
    {

        $bd = new Bd();
        return json_encode($bd->getCategoriasSelect());
    }
 public function actualizarCategoria()
    {





        $act = new ActualizarCat();
        $act->actualizar();
    }

    public function nuevoCategoria()
    {

       if(Cabecera::control()==false){

       }else{

           $act = new ActualizarCat();
           $act->llegan_datos();
           
           
           require('vistas/altaCategoria.php');
        }
    }
    public function irAltaCategoria()
    {



        require('vistas/altaCategoria.php');
    }
public function deleteCategoria()
    {
        if (isset($_GET['id'])) {
            $datos = [];
            $datos[0] = $_GET['id'];


            $bd = new Bd();
            $mensaje = $bd->deleteCategoria($datos);
            if ($mensaje != "No se pudo eliminar") {
                header('location:../categorias');
           
            } 
        }
    }








    
    }
