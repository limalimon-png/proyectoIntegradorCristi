<?php




class controllerGetsPublicos
{
   

    public function getProductosListaPorNombre()
    {





        if (isset($_GET['nombre'])) {
            $pagina = 0;
            $bd = new Bd();
            if (isset($_GET['pagina'])) {
                $pagina = $_GET['pagina'];
            }
            return json_encode($bd->getProductosPorNombre($pagina, $_GET['nombre']));
        }
    }
    public function getProductosListaPorCategoria()
    {
        if (isset($_GET['nombre'])) {
            $pagina = 0;
            $bd = new Bd();
            if (isset($_GET['pagina'])) {
                $pagina = $_GET['pagina'];
            }
            $bd = new Bd();

            return json_encode($bd->getProductosPorCategoria($pagina, $_GET['nombre']));
        }
    }
    public function getProductosVentas()
    {
        $bd = new Bd();
        $pagina = 0;
        $bd = new Bd();
        if (isset($_GET['pagina'])) {
            $pagina = $_GET['pagina'];
        }
        return json_encode($bd->getProductosPorVentas($pagina));
    }
    public function getProductosPuntuacion()
    {
        $bd = new Bd();
        $pagina = 0;
        $bd = new Bd();
        if (isset($_GET['pagina'])) {
            $pagina = $_GET['pagina'];
        }
        return json_encode($bd->getProductosPorPuntuacionTotal($pagina));
    }
    public function getCategoriasListaPorTitulo()
    {
        if (isset($_GET['nombre'])) {
            $pagina = 0;
            $bd = new Bd();
            if (isset($_GET['pagina'])) {
                $pagina = $_GET['pagina'];
            }
            $bd = new Bd();
            return json_encode($bd->getCategoriasPorNombre($pagina, $_GET['nombre']));
        }
    }
    public function getCategoriasListaPorDecripcion()
    {
        if (isset($_GET['nombre'])) {
            $pagina = 0;
            $bd = new Bd();
            if (isset($_GET['pagina'])) {
                $pagina = $_GET['pagina'];
            }
            $bd = new Bd();
            return json_encode($bd->getCategoriasPorDescripcion($pagina, $_GET['nombre']));
        }
    }
    public function getCategoriasPuntuacion()
    {

        $pagina = 0;
        $bd = new Bd();
        if (isset($_GET['pagina'])) {
            $pagina = $_GET['pagina'];
        }
        return json_encode($bd->getCategoriasPorPuntuacion($pagina));
    }


     public function getInfoPerfilPublico()
    {
        $db = new Bd();


        session_start();
        if (isset($_SESSION['credencialesPublicas'])) {
            return json_encode($db->getUsuarioPorEmail($_SESSION['credencialesPublicas'][0]));
        }
    }
    public function getComprasPerfilUsuario()
    {
        $db = new Bd();


        session_start();
        if (isset($_SESSION['credencialesPublicas'])) {
            return json_encode($db->getComprasUsuario($_SESSION['credencialesPublicas'][0]));
        }
    }
    public function getComentariosPerfilUsuario()
    {
        $db = new Bd();


        session_start();
        if (isset($_SESSION['credencialesPublicas'])) {
            return json_encode($db->getComentariosUsuario($_SESSION['credencialesPublicas'][0]));
        }
    }


    public function getDestacados()
    {
        $db = new Bd();
        session_start();
        if (isset($_SESSION['credencialesPublicas'])) {
            return json_encode($db->getProductosDestacados($_SESSION['credencialesPublicas'][0]));
        } else {
            return json_encode($db->getProductosDestacados($_GET['id']));
        }
    }
    public function getComentariosProducto()
    {
        $db = new Bd();


        if (isset($_GET['idObjeto']) && isset($_GET['pagina'])) {

            return json_encode($db->getComentariosObjeto($_GET['pagina'], $_GET['idObjeto']));
        } else {
            $a = [];
            $a[0] = "error";
            return json_encode($a);
        }
    }
    public function getComentarioUsuario()
    {
        $db = new Bd();
        if (isset($_GET['idObjeto'])) {

            session_start();
            if (isset($_SESSION['credencialesPublicas'])) {
                return json_encode($db->getComentarioUsuario($_GET['idObjeto'], $_SESSION['credencialesPublicas'][0]));
            }
        }
    }
   
}
