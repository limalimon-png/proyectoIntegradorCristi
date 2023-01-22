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



    public function actualizar(){
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
            $datos[$i]=$this->id;
                $i=$i+1;
           
           //ver como actualizamos la foto especifica

            $bd=new Bd();
            $bd->actualizar_objetos($datos);


            if (isset($_FILES['img']) && $_FILES['img']['size']!=0 && preg_match("/^image\//",$_FILES['img']['type'])==1) {
                $this->img = $_FILES['img'];
                $imagen=[];
                $imagen[0]=$this->img['name'];
                $imagen[1]=$this->id;
             
               
         
                //guardar imagen y actualizar con imagen
                $this->subirImagen1();
                $bd->actualizar_imagen1_objetos($imagen);
                
                
                
                
 
                
                // actualizar sin cambiar imagen
            }
            if (isset($_FILES['img2']) && $_FILES['img2']['size']!=0 && preg_match("/^image\//",$_FILES['img2']['type'])==1) {
                $this->img2 = $_FILES['img2'];
                $imagen=[];
                $imagen[0]=$this->img2['name'];
                $imagen[1]=$this->id;
                
                
                //guardar imagen y actualizar con imagen
                $this->subirImagen2();
                $bd->actualizar_imagen2_objetos($imagen);
                
                
                
                
       
                
                // actualizar sin cambiar imagen
            }
            if (isset($_FILES['img3']) && $_FILES['img3']['size']!=0 && preg_match("/^image\//",$_FILES['img3']['type'])==1) {
                $this->img3 = $_FILES['img3'];
                $imagen=[];
                $imagen[0]=$this->img3['name'];
                $imagen[1]=$this->id;
                
                
                //guardar imagen y actualizar con imagen
                $this->subirImagen3();
                $bd->actualizar_imagen3_objetos($imagen);

                

 
                
                // actualizar sin cambiar imagen
            }
            header('location:../productos/'.$this->id);
        }

    }
   


    public function llegan_datos(){
        if ($this->comprobarNuevo()) {

            //crear o modificar carpeta del servidor con la imagen
            //conexion con base de datos
            $i = 0;

            $datos = [];
            $datos[$i] = $this->nombre;
            $i = $i + 1;
            $datos[$i] = $this->descripcion;
            $i = $i + 1;
            $datos[$i] = $this->categoria; 
            $i = $i + 1;
            $datos[$i] = $this->precio;
            $i = $i + 1;
            $datos[$i] = $this->latitud;
            $i = $i + 1;
            $datos[$i] = $this->longitud;
            $i = $i + 1;




            $bd = new Bd();
            $this->id = $bd->setObjeto($datos);
            // echo $this->id;
            if ($this->id != false) {

                if (isset($_FILES['img']) && $_FILES['img']['size'] != 0 && preg_match("/^image\//", $_FILES['img']['type']) == 1) {
                    $this->img = $_FILES['img'];
                    $imagen = [];
                    $imagen[0] = $this->img['name'];
                    $imagen[1] = $this->id;

                    //guardar imagen y actualizar con imagen
                    $this->subirImagen1();
                    $bd->actualizar_imagen1_objetos($imagen);

                } 
                if (isset($_FILES['img2']) && $_FILES['img2']['size'] != 0 && preg_match("/^image\//", $_FILES['img2']['type']) == 1) {
                    $this->img2 = $_FILES['img2'];
                    $imagen = [];
                    $imagen[0] = $this->img2['name'];
                    $imagen[1] = $this->id;

                    //guardar imagen y actualizar con imagen
                    $this->subirImagen2();
                    $bd->actualizar_imagen2_objetos($imagen);
                } 

                if (isset($_FILES['img3']) && $_FILES['img3']['size'] != 0 && preg_match("/^image\//", $_FILES['img3']['type']) == 1) {
                    $this->img3 = $_FILES['img3'];
                    $imagen = [];
                    $imagen[0] = $this->img3['name'];
                    $imagen[1] = $this->id;

                    //guardar imagen y actualizar con imagen
                    $this->subirImagen3();
                    $bd->actualizar_imagen3_objetos($imagen);

                    
                }
                header('location:../productos/nuevo');
            } else {
                return false;
            }
        }

    }

//necesitamos 
    private function subirImagen1()
    {
        $tam = $_FILES["img"]["size"];
        if ($tam > $this->mega * 20) { //1024 bytes =1kb => 1024 *1024=1mb
            echo "archivo muy grande excede 20 megas ";
        } else {
            $aux= substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-5);
            $dir = $aux."vistas/galeria/objetos/$this->id/img1/";

            $temporal = $this->img["tmp_name"];
            $path = "$dir" . $this->img["name"];
            if (!is_dir($aux."vistas/galeria/objetos/$this->id")) {
                mkdir($aux."vistas/galeria/objetos/$this->id");
            } 
            if(!is_dir($dir)){
                mkdir($dir);
            }else{
                array_map('unlink', glob($dir."*"));
            }
            if (move_uploaded_file($temporal, $path)) {
            } else {
                //un error
                echo "no se pudo subir <br>";
            }
           
        }
     
        
    }
    private function subirImagen2()
    {
        $tam = $_FILES["img2"]["size"];
        if ($tam > $this->mega * 20) { //1024 bytes =1kb => 1024 *1024=1mb
            echo "archivo muy grande excede 20 megas ";
        } else {
            $aux= substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-5);
            $dir = $aux."vistas/galeria/objetos/$this->id/img2/";

            $temporal = $this->img2["tmp_name"];
            $path = "$dir" . $this->img2["name"];
            if (!is_dir($aux."vistas/galeria/objetos/$this->id")) {
                mkdir($aux."vistas/galeria/objetos/$this->id");
            } 
            if(!is_dir($dir)){
                mkdir($dir);
            }else{
                array_map('unlink', glob($dir."*"));
            }
             
            
            if (move_uploaded_file($temporal, $path)) {
            } else {
                //un error
                echo "no se pudo subir <br>";
            }
           
        }
     
        
    }
    private function subirImagen3()
    {
        $tam = $_FILES["img3"]["size"];
        if ($tam > $this->mega * 20) { //1024 bytes =1kb => 1024 *1024=1mb
            echo "archivo muy grande excede 20 megas ";
        } else {
            $aux= substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-5);
            $dir = $aux."vistas/galeria/objetos/$this->id/img3/";

            $temporal = $this->img3["tmp_name"];
            $path = "$dir" . $this->img3["name"];
            if (!is_dir($aux."vistas/galeria/objetos/$this->id")) {
                mkdir($aux."vistas/galeria/objetos/$this->id");
            } 
            if(!is_dir($dir)){
                mkdir($dir);
            }else{
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

    private function comprobarNuevo()
    {
        

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
