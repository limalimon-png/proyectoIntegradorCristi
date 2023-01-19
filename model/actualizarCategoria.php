<?php

// $n=$_GET["titulo"];
// $a=$_GET["descripcion"];


class ActualizarCat
{
    var $mega = 1024 * 1024;
    var $id;
    var $img;
    var $titulo;
    var $descripcion;
    var $puntuacion;
    var $categoria_padre;



    public function __construct()
    {



       




        if ($this->comprobar()) {

            //crear o modificar carpeta del servidor con la imagen
            //conexion con base de datos
            $i=0;
          
            $datos=[];
            $datos[$i]=$this->puntuacion;
            $i=$i+1;
            $datos[$i]=$this->titulo;
            $i=$i+1;
            $datos[$i]=$this->descripcion;
            $i=$i+1;
            // $datos[$i]=$this->categoria_padre;
            // $i=$i+1;
           
           

            $bd=new Bd();
            if (isset($_FILES['img']) && $_FILES['img']['size']!=0 && preg_match("/^image\//",$_FILES['img']['type'])==1) {
                $this->img = $_FILES['img'];
                $datos[$i]=$this->img['name'];
                $i=$i+1;
                $datos[$i]=$this->id;
                $i=$i+1;
               
         
                //guardar imagen y actualizar con imagen
                $this->subirImagen();

                

                $bd->actualizar_categoria($datos);
                header('location:../categorias/'.$this->id);
            } else {
                $datos[$i]=$this->id;
                $i=$i+1;
                $bd->actualizar_categoria($datos);
                header('location:../categorias/'.$this->id);
             
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
            $dir = $aux."vistas/galeria/categorias/$this->id/";

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

        if (isset($_POST['titulo'])) {
            $this->titulo = $_POST['titulo'];
        } else {
            return false;
        }
        if (isset($_POST['descripcion'])) {
            $this->descripcion = $_POST['descripcion'];
        } else {
            return false;
        }
        if (isset($_POST['puntuacion'])) {
            $this->puntuacion = $_POST['puntuacion'];
        } else {
            return false;
        }
      
        if (isset($_POST['categoria_padre'])) {
            $this->categoria_padre = $_POST['categoria_padre'];
        } else {
            return false;
        }

        return true;
    }
}
