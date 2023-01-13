<?php


use mail\Mailer;

class Controller
{
    var $categoria;
    var $productos;
    var $coches;
    var $cat;
    var $cats;
    var $pedidoValido = false;
    var $pedido;
    var $credencial;
    var $body;
    var $productosCarrito;
    var $mensaje;
    var $contenido;

    // function __construct()
    // {
    //     $this->coches = [
    //         1 => new Car("Wolkswagen", "Polo", "negro", "Rebeca", "coche_1.png"),
    //         2 => new Car("Toyota", "Corolla", "verde", "Marcos", "coche_2.png"),
    //         3 => new Car("Skoda", "Octavia", "gris", "Mario", "coche_3.png"),
    //         4 => new Car("Kia", "Niro", "azul", "Jairo", "coche_4.png"),
    //     ];
    // }

    public function porDefecto()
    {
        header('location:login');
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
        require("vistas/index.php");
    }

    public function tabla($name)
    {
        require("vistas/$name");
    }

    public function listaProductos()
    {
        $pagina=0;
        if (isset($_GET['tabla'])) {
            $tabla=$_GET('tabla');

            if(isset($_GET['pagina'])){
                $pagina=$_GET['pagina'];
            }
            
            $bd=new Bd();
            return( json_encode($bd->getLista($pagina,$tabla)));
          }else{
            return "no llega nada";
          }
    }

    // public function cargarVista($contenido, $plantilla)
    // {
    //     $this->contenido=$contenido;
    //     require_once($plantilla);
    // }

    public function autentication()
    {


        $user[0] = $_POST["user"];
        $user[1] = $_POST["pass"];

        $aut = new Sesion();
        $aut->login($user);

        $this->mensaje = $aut->getMensaje();
        if ($this->mensaje == 'correcto') {
            // pasa a la siguiente pestaña

            header('location:../control');
            // $this->cargarVista('contenido.php', 'index.php');
            // //    include('menulateral.php');
            // require('vistas/index.php');
        } else {
            //vuelve
            $this->mensaje = "prueba";
            // require('view/login.php');

            header('location:../login');
        }
    }



    

    // public function categorias()
    // {
    //     $db = new Bd();
    //     $this->cats = $db->getCategorias();
    //     require('view/categorias.php');
    //     echo Cabecera::menuCategorias();
    //     Cabecera::control();
    // }
    public function productos($prod)
    {
        $bd = new Bd();
        $this->productos = $bd->getProductos($prod);
        $this->categoria = $bd->getCategoria($prod);
        $this->cat = $prod;

        require('view/productos.php');



        echo Cabecera::menuProductos();
        Cabecera::control();
    }

    public function agregarProducto()
    {
        $agregar = new Agregar();
    }

    public function verCarrito()
    {
        Cabecera::control();

        if (isset($_SESSION['carrito'])) {

            if (!empty($_SESSION['carrito'])) {

                $bd = new Bd();

                $carrito = $_SESSION['carrito'];


                $this->productosCarrito = $bd->getProductosCarrito($carrito);


                require('view/carrito.php');
            } else {

                require("view/categorias.php");
            }
        } else {
            require("view/categorias.php");
        }

        echo Cabecera::menuCarrito();
    }



    public function procesarPedido()
    {
        Cabecera::control();
        $procesar = new Procesar();
        $this->pedidoValido = $procesar->getValido();


        if ($this->pedidoValido) {
            $this->pedidoValido = false;


            Cabecera::control();

            $mail = new Mailer();
            $bd = new Bd();
            $this->pedido = $bd->getPedido();

            $this->body = $_SESSION['credenciales'][0] . "ha realizado el pedido $this->pedido";
            $mail->enviarEmail(
                'guillermomartinez1222@gmail.com',
                'guillermomartinez1222@gmail.com',
                $this->body,
                "gomzra@gmail.com"
            );
            require('view/correo.php');
        }
    }

    public function cerrarSesion()
    {

        $logout = new Logout();
        require('vistas/login.php');
    }


    public function actualizarProducto()
    {
        $actualizar = new Eliminar();
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
    public function formularioPass()
    {

        require("view/formularioResetear.php");
    }
    public function comprobar()
    {

        $comprobar = new Reseteo();
        $resultado = $comprobar->getResulado();

        if ($resultado) {
            echo "se cambio correctamente";
            echo " <a href='../../../login'>Volver al login</a>";
        } else {
            echo "lo sentimos el email no es correcto";
            echo " <a href='../../../login'>Volver al login</a>";
        }
    }
}
