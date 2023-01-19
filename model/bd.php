
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


    // get con todos los datos paginados
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
            $sql = "SELECT  usuario.email as email_usuario, objeto.nombre as nombre_producto , fecha, comentario.comentario , id_usuario, id_objeto FROM comentario join usuario on comentario.id_usuario=usuario.id join objeto on objeto.id=comentario.id_objeto  Limit $pagina,$indice";
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
                $comentarios['id'] = $res[4]."_".$res[5];




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


//get un unico resultado

    public function getUsuario($id)
    {


        try {
          
            $db = $this->conexion();
            $sql = "SELECT * from usuario where id=$id";
            $stmt = $db->prepare($sql);
            $stmt->execute();


            $catalogo = [$stmt->rowCount()];
            $contador = 0;
            foreach ($stmt as $res) {

                $categoria = [];
                $categoria[0] = $res['foto'];
                $categoria[1] = $res['id'];
                $categoria[2] = $res['nombre'];
                $categoria[3] = $res['apellidos'];
                $categoria[4] = $res['email'];
                $categoria[5] = $res['password'];
                $categoria[6] = $res['monedero'];
           

                $catalogo[$contador] = $categoria;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getCategoria($id)
    {


        try {
       
            $db = $this->conexion();
            $sql = "SELECT categoria.titulo,categoria.descripcion, cat2.titulo as categoria_padre,categoria.foto,categoria.id FROM categoria join categoria as cat2 on cat2.id=categoria.categoria_padre where categoria.id=$id";
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

    public function getProducto($id)
    {
        try {
           
            $db = $this->conexion();
            $sql = "SELECT objeto.nombre, categoria.titulo as 'categoria', objeto.descripcion, objeto.precio, objeto.latitud, objeto.longitud, objeto.puntuacion_compra,objeto.puntuacion_comentarios, objeto.puntuacion_total , objeto.id , objeto.foto1 , objeto.foto2 , objeto.foto3 FROM objeto join categoria on objeto.id_categoria=categoria.id where objeto.id=$id";
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
                $producto['foto1'] = $res[10];
                $producto['foto2'] = $res[11];
                $producto['foto3'] = $res[12];



                $catalogo[$contador] = $producto;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function getComentario($id1,$id2)
    {
        $datos=[];
        $datos[0]=$id1;
        $datos[1]=$id2;
        try {
          
            $db = $this->conexion();
            $sql = "SELECT  usuario.email as email_usuario, objeto.nombre as nombre_producto , fecha, comentario.comentario ,comentario.id_usuario , comentario.id_objeto FROM comentario join usuario on comentario.id_usuario=usuario.id join objeto on objeto.id=comentario.id_objeto  where id_usuario=? and id_objeto=?";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);


            $catalogo = [$stmt->rowCount()];
            $contador = 0;
            foreach ($stmt as $res) {

                $comentarios = [];
                $comentarios['email usuario'] = $res[0];
                $comentarios['nombre usuario'] = $res[1];
                $comentarios['fecha'] = $res[2];
                $comentarios['comentario'] = $res[3];
                $comentarios['id'] = $res[4]."_".$res[5];




                $catalogo[$contador] = $comentarios;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    //actualizar datos

    public function actualizar_usuario($datos)
    {

        $consulta="";
        if(sizeof($datos)==6){
            $consulta="update  usuario set email=? , password=sha1(?) , nombre=? , apellidos=? , monedero=? where id=?";

        }else{
            $consulta="update  usuario set email=? , password=sha1(?) , nombre=? , apellidos=? , monedero=? , foto=? where id=?";
            
        }


        try {

            $db = $this->conexion();
            //insertamos el pedido
            $sql = $consulta;
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);


            $db = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }




    public function actualizar_categoria($datos)
    {

 

        


        try {

            $db = $this->conexion();
            //insertamos el pedido
            $sql = "update  categoria set categoria_padre=?, titulo=?, descripcion=? foto=? where id=?";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);


            $db = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    public function actualizar_objetos($datos)
    {

        $consulta="";
        if(sizeof($datos)==7){
            $consulta="update  objeto set id_categoria=? , nombre=? , descripcion=? , precio=? , latitud=? , longitud=? where id=?";

        }elseif(sizeof($datos)==8){
            $consulta="update  objeto set id_categoria=? , nombre=? , descripcion=? , precio=? , latitud=? , longitud=? , foto1=? where id=?";
            
        }elseif(sizeof($datos)==9){
            $consulta="update  objeto set id_categoria=? , nombre=? , descripcion=? , precio=? , latitud=? , longitud=? , foto1=? , foto2=? where id=?";

        }else{
            $consulta="update  objeto set id_categoria=? , nombre=? , descripcion=? , precio=? , latitud=? , longitud=? , foto1=? , foto2=? , foto3=? where id=?";
        }


        try {

            $db = $this->conexion();
            //insertamos el pedido
            $sql = $consulta;
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);


            $db = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function actualizar_comentarios($datos)
    {

      


        try {

            $db = $this->conexion();
            //insertamos el pedido
            $sql = "update  comentario set comentario=? , fecha=?  where id_usuario=? and id_objeto=?";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);


            $db = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }




}


?>