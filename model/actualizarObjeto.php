<?php

// $n=$_GET["nombre"];
// $a=$_GET["apellidos"];


class ActualizarObj
{
    var $mega = 1024 * 1024;
    var $id;
    var $img,$img2,$img3;
    var $nombre;
    var $descripcion;
    var $precio;
    var $latitud;
    var $longitud;
    var $categoria;


    public function __construct()
    {



       




        if ($this->comprobar()) {

            //crear o modificar carpeta del servidor con la imagen
            //conexion con base de datos
            $i=0;
          
            $datos=[];
            $datos[$i]=$this->nombre;
            $i=$i+1;
            $datos[$i]=$this->descripcion;
            $i=$i+1;
            $datos[$i]=$this->precio;
            $i=$i+1;
            $datos[$i]=$this->latitud;
            $i=$i+1;
            $datos[$i]=$this->longitud;
            $i=$i+1;
            $datos[$i]=$this->categoria;
            $i=$i+1;
           
           //ver como actualizamos la foto especifica

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


//necesitamos 
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
        if (isset($_POST['descripcion'])) {
            $this->descripcion = $_POST['descripcion'];
        } else {
            return false;
        }
        if (isset($_POST['categoria'])) {
            $this->categoria = $_POST['categoria'];
        } else {
            return false;
        }
        if (isset($_POST['precio'])) {
            $this->precio = $_POST['precio'];
        } else {
            return false;
        }
        if (isset($_POST['latitud'])) {
            $this->latitud = $_POST['latitud'];
        } else {
            return false;
        }
        if (isset($_POST['longitud'])) {
            $this->longitud = $_POST['longitud'];
        } else {
            return false;
        }
       

        return true;
    }
}
