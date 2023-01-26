<?php


use mail\Mailer;

class Controller
{



    // function __construct()
    // {
    //     $this->coches = [
    //         1 => new Car("Wolkswagen", "Polo", "negro", "Rebeca", "coche_1.png"),
    //         2 => new Car("Toyota", "Corolla", "verde", "Marcos", "coche_2.png"),
    //         3 => new Car("Skoda", "Octavia", "gris", "Mario", "coche_3.png"),
    //         4 => new Car("Kia", "Niro", "azul", "Jairo", "coche_4.png"),
    //     ];
    // }

    public function porDefecto($vueltas)
    {
        $cadena = "";
        for ($i = 0; $i < $vueltas; $i++) {
            $cadena = $cadena . '../';
        }
        header('location:' . $cadena . 'index.php/home');
    }
    public function index()
    {

        //Asigno los coches a una variable que estará esperando la vista
        $rowset = $this->coches;

        $photoPath = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
        $ruta = str_replace("index.php/", "", $photoPath);
        //echo $ruta;

        //Le paso los datos a la vista
        require("view/index.php");
    }

    public function home()
    {


        $photoPath = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
        $ruta = str_replace("index.php/", "", $photoPath);
        if (substr($ruta, -1) == '/') {
            $this->porDefecto(1);
        } else {


            //Le paso los datos a la vista
            require("vistas/publicas/home.php");
        }
    }

    public function productos()
    {


        $photoPath = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
        $ruta = str_replace("index.php/", "", $photoPath);



        //Le paso los datos a la vista
        require("vistas/publicas/listaProductos.php");
    }

    public function categorias()
    {


        $photoPath = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
        $ruta = str_replace("index.php/", "", $photoPath);



        //Le paso los datos a la vista
        require("vistas/publicas/listaCategorias.php");
    }
    public function contacto()
    {


        $photoPath = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
        $ruta = str_replace("index.php/", "", $photoPath);



        //Le paso los datos a la vista
        require("vistas/publicas/contacto.php");
    }
    public function loginPublico()
    {


        $photoPath = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
        $ruta = str_replace("index.php/", "", $photoPath);



        //Le paso los datos a la vista
        require("vistas/publicas/login.php");
    }
    public function register()
    {


        $photoPath = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
        $ruta = str_replace("index.php/", "", $photoPath);



        //Le paso los datos a la vista
        require("vistas/publicas/register.php");
    }


    public function show($id)
    {

        if (array_key_exists($id, $this->coches)) {
            //Si el elemento está en el array, lo muestro
            $row = $this->coches[$id];
            $photoPath = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"];
            $ruta = str_replace("index.php/show/" . $id, "", $photoPath);
            require("view/login.php");
        } else {
            //Llamo al método por defecto del controlador
            $this->index();
        }
    }


    public function login()
    {
        require("vistas/login.php");
    }

    public function forgetAdmin()
    {
        require("vistas/forget.php");
    }

    public function panelControl()
    {
        $control = new Cabecera();
        $control->control();
        require("vistas/index.php");
    }

    public function tabla($name)
    {
        require("vistas/$name");
    }

    public function verFicha($info)
    {
        require("vistas/ficha$info.php");
    }



    public function autentication()
    {


        $user[0] = $_POST["user"];
        $user[1] = $_POST["pass"];
        if(preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/",$user[0])==1 &&preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",$user[1])==1 ){
            header('location:../login?error=1');
        }else{

     

        $aut = new Sesion();
        $aut->login($user);

        $this->mensaje = $aut->getMensaje();
        if ($this->mensaje == 'correcto') {
            // pasa a la siguiente pestaña
            // echo "en el if";
            header('location:../control');
            // $this->cargarVista('contenido.php', 'index.php');
            // //    include('menulateral.php');
            // require('vistas/index.php');
        } else {
            //vuelve
            echo   $this->mensaje = "prueba";
            // require('view/login.php');

            header('location:../login?error=1');
        }
    }
    }


    public function autenticationPublica()
    {


        $user[0] = $_POST["user"];
        $user[1] = $_POST["pass"];

        $aut = new Sesion();
        $aut->loginPublico($user);

        $this->mensaje = $aut->getMensaje();
        if ($this->mensaje == 'correcto') {
            // pasa a la siguiente pestaña
            // echo "en el if";
            header('location:../home');
            // $this->cargarVista('contenido.php', 'index.php');
            // //    include('menulateral.php');
            // require('vistas/index.php');
        } else {
            //vuelve
            //  echo   $this->mensaje = "prueba";
            // require('view/login.php');

            header('location:../login?error=1');
        }
    }

    public function irRegister()
    {
        require("vistas/publicas/register.php");
    }
    public function irPerfil()
    {
        require("vistas/publicas/contacto.php");
    }

    public function autenticationRegister()
    {
        $act = new Actualizar();
        $act->llegan_datosPublicos();
    }

    

    public function comprarobjeto()
    {
        $db = new Bd();
        if (isset($_GET['idObjeto'])) {

            session_start();
            if (isset($_SESSION['credencialesPublicas'])) {
                return json_encode($db->comprarObjeto($_GET['idObjeto'], $_SESSION['credencialesPublicas'][0]));
            }
        }
    }


   
    public function actualizarUsuarioPublico()
    {
        $act = new Actualizar();
        $act->actualizarPublico();
    }



    public function actualizarComentarioUsuario()
    {
        if (isset($_GET['idObjeto']) && isset($_GET['comentario'])) {

            session_start();
            if (isset($_SESSION['credencialesPublicas'])) {
                $db = new Bd();
                $datos = [];
                $datos[2] = $_GET['idObjeto'];
                $datos[1] = $_SESSION['credencialesPublicas'][0];
                $datos[0] = $_GET['comentario'];
                return json_encode($db->actualizar_comentario($datos));
            }
        }
    }
    public function setComentarioUsuario()
    {
        if (isset($_GET['idObjeto']) && isset($_GET['comentario']) && isset($_GET['fecha'])) {

            session_start();
            if (isset($_SESSION['credencialesPublicas'])) {
                $db = new Bd();
                $datos = [];
                $datos[0] = $_SESSION['credencialesPublicas'][0];
                $datos[1] = $_GET['idObjeto'];
                $datos[3] = $_GET['fecha'];
                $datos[2] = $_GET['comentario'];
                return json_encode($db->setComentarioPublico($datos));
            }
        }
    }

    public function deleteComentarioUsuario()
    {
        if (isset($_GET['idObjeto'])) {

            session_start();
            if (isset($_SESSION['credencialesPublicas'])) {
                $db = new Bd();
                $datos = [];
                $datos[1] = $_GET['idObjeto'];
                $datos[0] = $_SESSION['credencialesPublicas'][0];
                return json_encode($db->deleteComentarioUsuario($datos));
            }
        }
    }






    public function cerrarSesion()
    {

        $logout = new Logout();
        require('vistas/login.php');
        header('location:login');
    }
    public function cerrarSesionPublico()
    {

        $logout = new Logout();
        header('location:home');
    }





    public function registroProcess()
    {


        $user[0] = $_POST["user"];
        $user[1] = $_POST["pass"];
        $user[2] = $_POST["direc"];

        $aut = new Sesion();
        $aut->registro($user);
        $this->mensaje = $aut->getMensaje();
        if ($this->mensaje == 'correcto') {
            // pasa a la siguiente pestaña
            $_POST["mensaje"] = "";

            header('location:../categorias');
        } else {
            //vuelve
            $_POST["mensaje"] = $this->mensaje;
            echo $_POST["mensaje"];
            header('location:../registro');
        }
    }
    public function registro()
    {
        require("view/registro.php");
    }


    public function resetearFormulario()
    {
        require("view/formulario.php");
    }


    public function enviarMail()
    {

        $mail = new Mailer();

        $email = sha1($_POST["email"]);

        $mail->enviarEmail(
            $_POST["email"],
            $_POST["email"],
            "<a href='localhost/proyecto/practica13/index.php/password/regenerar/formulario?id=$email'>Resetear constraseña</a>",
            "gomzra@gmail.com"
        );
        // require('view/correo.php');

    }



    public function eliminarUsuarioPublico(){
        $db = new Bd();


        session_start();
        if (isset($_SESSION['credencialesPublicas'])) {
        $db->deleteUsuarioPublico($_SESSION['credencialesPublicas'][0]);
         $this->cerrarSesionPublico();
        header('location:contacto');
        }

    }
}
