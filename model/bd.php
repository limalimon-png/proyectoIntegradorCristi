
<?php
class Bd
{
    private $ultimoId;

    public function getPedido()
    {
        $pedido = file_get_contents('store');

        $this->ultimoId = unserialize($pedido);
        return $this->ultimoId;
    }
    public static function conexion()
    {

        return new PDO('mysql:host=localhost;dbname=metabase', 'root', '');
    }


    // public function getCategorias()
    // {
    //     try {

    //         $db = $this->conexion();
    //         $sql = "SELECT * FROM categoria";
    //         $stmt = $db->prepare($sql);
    //         $stmt->execute();


    //         $catalogo = [$stmt->rowCount()];
    //         $contador = 0;
    //         foreach ($stmt as $res) {

    //             $categoria = [];
    //             $categoria[0] = $res["nombre"];
    //             $categoria[1] = $res["codCat"];
    //             $categoria[2] = $res["descripcion"];


    //             $catalogo[$contador] = $categoria;
    //             $contador++;
    //         }
    //         $db = null;
    //         return $catalogo;
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //     }
    // }
    public function getCategoria($cat)
    {
        try {

            $db = $this->conexion();
            $sql = "SELECT * FROM categoria where sha1(codCat)=?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($cat));


            $catalogo = [$stmt->rowCount()];
            $contador = 0;
            foreach ($stmt as $res) {

                $categoria = [];
                $categoria[0] = $res["nombre"];
                $categoria[1] = $res["descripcion"];


                $catalogo[$contador] = $categoria;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    // public function getProductos($cod)
    // {
    //     try {

    //         $db = $this->conexion();
    //         $sql = "SELECT * FROM producto where sha1(codCat)=?";
    //         $stmt = $db->prepare($sql);
    //         $stmt->execute(array($cod));


    //         $catalogo = [$stmt->rowCount()];
    //         $contador = 0;
    //         foreach ($stmt as $res) {

    //             $producto = [];
    //             $producto[0] = $res["nombre"];
    //             $producto[1] = $res["descripcion"];
    //             $producto[2] = $res["peso"];
    //             $producto[3] = $res["stock"];
    //             $producto[4] = $res["codProd"];


    //             $catalogo[$contador] = $producto;
    //             $contador++;
    //         }
    //         $db = null;
    //         return $catalogo;
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //     }
    // }
    public  function getProductosCarrito($carrito)
    {
        $cadena = "";
        $cont = 0;
        foreach ($carrito as $key => $value) {
            if ($cont == 0) {
                $cadena = $cadena . "$key";
                $cont = 1;
            } else {
                $cadena = $cadena . ",$key";
            }
        }
        $cadena = ' codProd in (' . $cadena . ')';




        try {

            $db = $this->conexion();
            $sql = "SELECT * FROM producto where  $cadena ";
            $stmt = $db->prepare($sql);
            $stmt->execute();


            $catalogo = [];
            $contador = 0;
            foreach ($stmt as $res) {

                $producto = [];
                $producto[0] = $res["nombre"];
                $producto[1] = $res["descripcion"];
                $producto[2] = $res["peso"];
                $producto[3] = $res["stock"];
                $producto[4] = $res["codProd"];


                $catalogo[$contador] = $producto;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }




    public  function procesarDetallePedidos($unidades, $codigo)
    {



        try {

            $db = $this->conexion();

            $datos[0] = $this->ultimoId;
            $datos[1] = $codigo;
            $datos[2] = $unidades;

            $sql = "insert into detallepedido (codPed,codProd,numUnidades) values(?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);
            $db = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function procesarPedidos($codRes)
    {

        $datos[0] = date('Y-m-d');
        $datos[1] = $codRes;


        try {

            $db = $this->conexion();
            //insertamos el pedido
            $sql = "insert into pedido (fecha,enviado,codRes) values(?,'noenviado',?)";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);
            //cogemos el ultimo insertado
            $this->ultimoId = $db->lastInsertId();
            $pedido = serialize($this->ultimoId);
            file_put_contents('store', $pedido);

            $db = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function pedidoEnviado()
    {

        $array[0] = $this->ultimoId;


        try {

            $db = $this->conexion();
            //insertamos el pedido
            $sql = "update  pedido set enviado=enviado where codPed=?";
            $stmt = $db->prepare($sql);
            $stmt->execute($array);


            $db = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    public function resetearPass($email, $pass): bool
    {

        try {

            $db = $this->conexion();
            $sql = "SELECT codRes FROM restaurante where sha1(correo)=?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($email));

            $id = 0;
            $contador = 0;
            foreach ($stmt as $res) {


                $id = $res["codRes"];




                $contador++;
            }
            $db = null;


            if ($contador == 1) {


                $db = $this->conexion();
                //insertamos el pedido
                $sql = "update  restaurante set clave=? where codRes=$id";
                $stmt = $db->prepare($sql);
                $stmt->execute(array($pass));


                $db = null;

                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function getCategorias($pagina)
    {


        try {
            $pagina = $pagina * 10;
            $indice = 10;
            if ($pagina != 0) {

                $indice = $pagina + 10;
            }
            $db = $this->conexion();
            $sql = "SELECT categoria.titulo,categoria.descripcion, cat2.titulo as categoria_padre,categoria.foto,categoria.id FROM categoria join categoria as cat2 on cat2.id=categoria.categoria_padre Limit $pagina,$indice";
            $stmt = $db->prepare($sql);
            $stmt->execute();


            $catalogo = [$stmt->rowCount()];
            $contador = 0;
            foreach ($stmt as $res) {

                $categoria = [];
                $categoria['titulo'] = $res[0];
                $categoria['descripcion'] = $res[1];
                $categoria['titulo categoria padre'] = $res[2];
                $categoria['foto'] = $res[3];
                $categoria['id'] = $res[4];
           

                $catalogo[$contador] = $categoria;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getProductos($pagina)
    {
        try {
            $pagina = $pagina * 10;
            $indice = 10;
            if ($pagina != 0) {

                $indice = $pagina + 10;
            }
            $db = $this->conexion();
            $sql = "SELECT objeto.nombre, categoria.titulo as 'categoria', objeto.descripcion, objeto.precio, objeto.latitud, objeto.longitud, objeto.puntuacion_compra,objeto.puntuacion_comentarios, objeto.puntuacion_total , objeto.id FROM objeto join categoria on objeto.id_categoria=categoria.id Limit $pagina,$indice";
            $stmt = $db->prepare($sql);
            $stmt->execute();


            $catalogo = [$stmt->rowCount()];
            $contador = 0;
            foreach ($stmt as $res) {

                $producto = [];
                $producto['nombre'] = $res[0];
                $producto['categoria'] = $res[1];
                $producto['descripcion'] = $res[2];
                $producto['precio'] = $res[3];
                $producto['latitud'] = $res[4];
                $producto['longitud'] = $res[5];
                $producto['puntuacion_compra'] = $res[6];
                $producto['puntuacion_comentarios'] = $res[7];
                $producto['puntuacion_total'] = $res[8];
                $producto['id'] = $res[9];



                $catalogo[$contador] = $producto;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getUsuarios($pagina)
    {

        try {
            $pagina = $pagina * 10;
            $indice = 10;
            if ($pagina != 0) {

                $indice = $pagina + 10;
            }
            $db = $this->conexion();
            $sql = "SELECT nombre, email, apellidos, monedero, foto, id FROM usuario Limit $pagina,$indice";
            $stmt = $db->prepare($sql);
            $stmt->execute();


            $catalogo = [$stmt->rowCount()];
            $contador = 0;
            foreach ($stmt as $res) {

                $producto = [];
                $producto['nombre'] = $res[0];
                $producto['email'] = $res[1];
                $producto['apellidos'] = $res[2];
                $producto['monedero'] = $res[3];
                $producto['foto'] = $res[4];
                $producto['id'] = $res[5];




                $catalogo[$contador] = $producto;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getComentarios($pagina)
    {

        try {
            $pagina = $pagina * 10;
            $indice = 10;
            if ($pagina != 0) {

                $indice = $pagina + 10;
            }
            $db = $this->conexion();
            $sql = "SELECT  usuario.email as email_usuario, objeto.nombre as nombre_producto , fecha, comentario.comentario FROM comentario join usuario on comentario.id_usuario=usuario.id join objeto on objeto.id=comentario.id_objeto  Limit $pagina,$indice";
            $stmt = $db->prepare($sql);
            $stmt->execute();


            $catalogo = [$stmt->rowCount()];
            $contador = 0;
            foreach ($stmt as $res) {

                $comentarios = [];
                $comentarios['email usuario'] = $res[0];
                $comentarios['nombre usuario'] = $res[1];
                $comentarios['fecha'] = $res[2];
                $comentarios['comentario'] = $res[3];
                $comentarios['id'] = 0;




                $catalogo[$contador] = $comentarios;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getLista($pagina, $tabla)
    {
        switch ($tabla) {
            case 'productos':
                return $this->getProductos($pagina);
            case 'categorias':
                return $this->getCategorias($pagina);
            case 'usuarios':
                return $this->getUsuarios($pagina);
            case 'comentarios':
                return $this->getComentarios($pagina);
        }
    }
}


?>