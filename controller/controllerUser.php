<?php


use mail\Mailer;

class ControllerUsuarios
{
  
    public function infoUsuario()
    {
        $control = new Cabecera();
        $control->control();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];



            $bd = new Bd();
            return (json_encode($bd->getUsuario($id)));
        } else {
            return "no llega nada";
        }
    }
 public function infoUsuarios()
    {

        $bd = new Bd();
        return json_encode($bd->getUsuariosSelect());
    }
 public function actualizarUsuario()
    {





        $act = new Actualizar();
        $act->actualizar();;
    }
 public function nuevoUsuario()
    {

        $control = new Cabecera();
        $control->control();

        $act = new Actualizar();
        $act->llegan_datos();


        require('vistas/altaUsuario.php');
    }
    public function irAltaUsuario()
    {



        require('vistas/altaUsuario.php');
    }
public function deleteUsuario()
    {
        if (isset($_GET['id'])) {
            $datos = [];
            $datos[0] = $_GET['id'];


            $bd = new Bd();
            $mensaje = $bd->deleteUsuario($datos);
            if ($mensaje != "No se pudo eliminar") {
                header('location:../usuarios');
           
            } 
        }
    }











    }
