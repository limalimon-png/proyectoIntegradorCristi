<?php


use mail\Mailer;

class ControllerComentarios
{
    
    

    public function infoComentario()
    {


        if (isset($_GET['idU']) && isset($_GET['idO'])) {
            $idU = $_GET['idU'];
            $idO = $_GET['idO'];



            $bd = new Bd();
            return (json_encode($bd->getComentario($idU, $idO)));
        } else {
            return "no llega nada";
        }
    }
   public function nuevoComentario()
    {

        
        if (isset($_POST['idUsuario']) && isset($_POST['idObjeto']) && isset($_POST['fecha']) && isset($_POST['comentario'])) {



            $datos = [];
            $datos[0] = $_POST['idUsuario'];
            $datos[1] = $_POST['idObjeto'];
            $datos[2] = $_POST['fecha'];
            $datos[3] = $_POST['comentario'];

            $bd = new Bd();
            $bd->setComentario($datos);
        }

        header('location:../comentarios/nuevo');
    }
    public function irAltaComentario()
    {



        require('vistas/altaComentarios.php');
    }
public function actualizarComentario()
    {

        if (isset($_POST['idUsuario']) && isset($_POST['idObjeto']) && isset($_POST['fecha']) && isset($_POST['comentario'])) {
            $datos = [];
            $datos[2] = $_POST['idUsuario'];
            $datos[3] = $_POST['idObjeto'];
            $datos[1] = $_POST['fecha'];
            $datos[0] = $_POST['comentario'];
            $bd = new Bd();
            $bd->actualizar_comentarios($datos);
        }
        header('location:../comentarios/' . $_POST['idUsuario'] . '_' . $_POST['idObjeto']);
    }
public function deleteComentario()
    {
        if (isset($_GET['idU']) && isset($_GET['idO'])) {
            $datos = [];
            $datos[0] = $_GET['idU'];
            $datos[1] = $_GET['idO'];

            $bd = new Bd();
            $mensaje = $bd->deleteComentario($datos);
            if ($mensaje != "No se pudo eliminar") {
                header('location:../comentarios');
           
            } 
                
            
        }
    }








    
    }
