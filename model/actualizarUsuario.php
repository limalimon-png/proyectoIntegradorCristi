<?php

// $n=$_GET["nombre"];
// $a=$_GET["apellidos"];


class Actualizar
{
    var $mega = 1024 * 1024;
    var $id;
    var $img;
    var $nombre;
    var $apellidos;
    var $pass;
    var $monedero;
    var $email;


    public function __construct()
    {



       




        if ($this->comprobar()) {

            //crear o modificar carpeta del servidor con la imagen
            //conexion con base de datos
            $i=0;
          
            $datos=[];
            $datos[$i]=$this->email;
            $i=$i+1;
            $datos[$i]=$this->pass;
            $i=$i+1;
            $datos[$i]=$this->nombre;
            $i=$i+1;
            $datos[$i]=$this->apellidos;
            $i=$i+1;
            $datos[$i]=$this->monedero;
            $i=$i+1;
           
           

            $bd=new Bd();
            if (isset($_FILES['img']) && $_FILES['img']['size']!=0 && preg_match("/^image\//",$_FILES['img']['type'])==1) {
                $this->img = $_FILES['img'];
                $datos[$i]=$this->img['name'];
                $i=$i+1;
                $datos[$i]=$this->id;
                $i=$i+1;
               
         
                //guardar imagen y actualizar con imagen
                $this->subirImagen();

                

                $bd->actualizar_usuario($datos);
                header('location:../'.$this->id);
            } else {
                $datos[$i]=$this->id;
                $i=$i+1;
                $bd->actualizar_usuario($datos);
                header('location:../'.$this->id);
             
                // actualizar sin cambiar imagen
            }
        }
    }



    private function subirImagen()
    {
        $tam = $_FILES["img"]["size"];
        if ($tam > $this->mega * 20) { //1024 bytes =1kb => 1024 *1024=1mb
            echo "archivo muy grande excede 20 megas ";
        } else {
            $aux= substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-5);
            $dir = $aux."vistas/galeria/$this->id/";

            $temporal = $this->img["tmp_name"];
            $path = "$dir" . $this->img["name"];

            if (!is_dir($dir)) {
                mkdir($dir);
            } else {
                array_map('unlink', glob($dir."*"));
             
            }
            if (move_uploaded_file($temporal, $path)) {
            } else {
                //un error
                echo "no se pudo subir <br>";
            }
           
        }
     
        
    }
    private function comprobar()
    {
        if (isset($_POST['id'])) {
            $this->id = $_POST['id'];
        } else {
            return false;
        }

        if (isset($_POST['nombre'])) {
            $this->nombre = $_POST['nombre'];
        } else {
            return false;
        }
        if (isset($_POST['apellidos'])) {
            $this->apellidos = $_POST['apellidos'];
        } else {
            return false;
        }
        if (isset($_POST['pass'])) {
            $this->pass = $_POST['pass'];
        } else {
            return false;
        }
        if (isset($_POST['email'])) {
            $this->email = $_POST['email'];
        } else {
            return false;
        }
        if (isset($_POST['monedero'])) {
            $this->monedero = $_POST['monedero'];
        } else {
            return false;
        }

        return true;
    }
}
