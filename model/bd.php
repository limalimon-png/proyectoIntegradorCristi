
<?php
class Bd
{
    private $ultimoId;

    
    public static function conexion()
    {

        return new PDO('mysql:host=localhost;dbname=metabase', 'root', '');
     
    }












    //set Objetos categorias comentarios y usuarios

    public function comprarObjeto($idObjeto,$email){
        $fecha = date("Y-m-d");
        $datos = array($email,$idObjeto,$fecha);
        try {


            $db = $this->conexion();
            $sql = "insert into compra  values ((select id from usuario where email=?),?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);
            $db = null;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function setUsuario($datos)
    {

        try {

            $db = $this->conexion();
            $sql = "insert into usuario (email,password,nombre,apellidos,monedero) values (?,sha1(?),?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);


            $last = $db->lastInsertId();
            echo $last;
            $db = null;
            return $last;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function setObjeto($datos)
    {

        try {

            $db = $this->conexion();
            $sql = "insert into objeto (nombre,descripcion,id_categoria,precio,latitud,longitud) values (?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);


            $last = $db->lastInsertId();
            echo $last;
            $db = null;
            return $last;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }


    public function setCategoria($datos)
    {
        if ($datos[1] == 0) {
            $datos[1] = null;
        }



        try {

            $db = $this->conexion();
            $sql = "insert into categoria (titulo,categoria_padre,descripcion,puntuacion) values (?,?,?,0)";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);


            $last = $db->lastInsertId();

            $db = null;
            return $last;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function setComentario($datos)
    {
       


        try {

            $db = $this->conexion();
            $sql = "insert into comentario (id_usuario,id_objeto,fecha,comentario) values (?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);


           

            $db = null;
          
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    public function setComentarioPublico($datos)
    {
       


        try {

            $db = $this->conexion();
            $sql = "insert into comentario  values ((select id from usuario where email=?),?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);


           

            $db = null;
          
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
    //gets para formularios
    public function getCategoriasSelect()
    {


        try {

            $db = $this->conexion();
            $sql = "SELECT categoria.titulo,categoria.id  FROM categoria";
            $stmt = $db->prepare($sql);
            $stmt->execute();


            $catalogo = [$stmt->rowCount()];
            $contador = 0;
            foreach ($stmt as $res) {

                $categoria = [];
                $categoria['titulo'] = $res[0];
                $categoria['id'] = $res[1];



                $catalogo[$contador] = $categoria;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getUsuariosSelect()
    {


        try {

            $db = $this->conexion();
            $sql = "SELECT email,id  FROM usuario";
            $stmt = $db->prepare($sql);
            $stmt->execute();


            $catalogo = [$stmt->rowCount()];
            $contador = 0;
            foreach ($stmt as $res) {

                $categoria = [];
                $categoria['email'] = $res[0];
                $categoria['id'] = $res[1];



                $catalogo[$contador] = $categoria;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getProductosSelect()
    {


        try {

            $db = $this->conexion();
            $sql = "SELECT nombre,id  FROM objeto";
            $stmt = $db->prepare($sql);
            $stmt->execute();


            $catalogo = [$stmt->rowCount()];
            $contador = 0;
            foreach ($stmt as $res) {

                $categoria = [];
                $categoria['nombre'] = $res[0];
                $categoria['id'] = $res[1];



                $catalogo[$contador] = $categoria;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
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
            $sql = "SELECT categoria.titulo,categoria.descripcion, cat2.titulo as categoria_padre,categoria.foto,categoria.id FROM categoria left join categoria as cat2 on cat2.id=categoria.categoria_padre Limit $pagina,$indice";
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
    public function getCategoriasPorNombre($pagina,$nombre)
    {


        try {
            $pagina = $pagina * 10;
            $indice = 10;
            if ($pagina != 0) {

                $indice = $pagina + 10;
            }
            $db = $this->conexion();
            $sql = "SELECT categoria.titulo,categoria.descripcion, cat2.titulo as categoria_padre,categoria.foto,categoria.id ,
            (SELECT SUM(puntuacion_compra+puntuacion_comentarios) as puntuacion FROM `objeto` where  id_categoria=categoria.id) as puntuacion
            FROM categoria left join categoria as cat2 on cat2.id=categoria.categoria_padre where categoria.titulo like ('%$nombre%') order by puntuacion desc Limit $pagina,$indice";
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
                $categoria['puntuacion'] = $res[5];


                $catalogo[$contador] = $categoria;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getCategoriasPorDescripcion($pagina,$nombre)
    {


        try {
            $pagina = $pagina * 10;
            $indice = 10;
            if ($pagina != 0) {

                $indice = $pagina + 10;
            }
            $db = $this->conexion();
            $sql = "SELECT categoria.titulo,categoria.descripcion, cat2.titulo as categoria_padre,categoria.foto,categoria.id ,
            (SELECT SUM(puntuacion_compra+puntuacion_comentarios) as puntuacion FROM `objeto` where  id_categoria=categoria.id) as puntuacion
            FROM categoria left join categoria as cat2 on cat2.id=categoria.categoria_padre where categoria.descripcion like ('%$nombre%') order by puntuacion desc Limit $pagina,$indice";
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
                $categoria['puntuacion'] = $res[5];


                $catalogo[$contador] = $categoria;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getCategoriasPorPuntuacion($pagina)
    {


        try {
            $pagina = $pagina * 10;
            $indice = 10;
            if ($pagina != 0) {

                $indice = $pagina + 10;
            }
            $db = $this->conexion();
            $sql = "SELECT categoria.titulo,categoria.descripcion, cat2.titulo as categoria_padre,categoria.foto,categoria.id ,
            (SELECT SUM(puntuacion_compra+puntuacion_comentarios) as puntuacion FROM `objeto` where  id_categoria=categoria.id) as puntuacion
            FROM categoria left join categoria as cat2 on cat2.id=categoria.categoria_padre  order by puntuacion desc Limit $pagina,$indice";
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
                $categoria['puntuacion'] = $res[5];
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


    public function getProductosDestacados($id)
    {
        try {
          $consulta="";
          if($id!=0){
            $consulta="SELECT id,foto1,nombre,descripcion,precio FROM `objeto` join comentario on id=id_objeto where id_usuario=(select id from usuario where email='$id')  order by fecha desc  LIMIT 10;";

          }else{

            $consulta="SELECT id,foto1,nombre,descripcion,precio FROM `objeto`  order by (puntuacion_compra+puntuacion_comentarios) desc LIMIT 10;";

          }
            
            $db = $this->conexion();
            $sql = $consulta;
            $stmt = $db->prepare($sql);
            $stmt->execute();


            $catalogo = [$stmt->rowCount()];
            $contador = 0;
            foreach ($stmt as $res) {

                $producto = [];
                $producto['id'] = $res[0];
                $producto['foto1'] = $res[1];
                $producto['nombre'] = $res[2];
                $producto['descripcion'] = $res[3];
                $producto['precio'] = $res[4];
           



                $catalogo[$contador] = $producto;
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

    public function getProductosPorNombre($pagina,$nombre)
    {
        
        try {
            $pagina = $pagina * 10;
            $indice = 10;
            if ($pagina != 0) {

                $indice = $pagina + 10;
            }
            $db = $this->conexion();
            $sql = "SELECT objeto.nombre, categoria.titulo as 'categoria', objeto.descripcion, objeto.precio, objeto.latitud, objeto.longitud, objeto.puntuacion_compra,objeto.puntuacion_comentarios, objeto.puntuacion_total ,objeto.foto1,objeto.foto2,objeto.foto3, objeto.id FROM objeto join categoria on objeto.id_categoria=categoria.id  where objeto.nombre like ('%$nombre%') Limit $pagina,$indice";
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
                $producto['foto1'] = $res[9];
                $producto['foto2'] = $res[10];
                $producto['foto3'] = $res[11];
                $producto['id'] = $res[12];;



                $catalogo[$contador] = $producto;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getProductosPorCategoria($pagina,$nombre)
    {
        try {
            $pagina = $pagina * 10;
            $indice = 10;
            if ($pagina != 0) {

                $indice = $pagina + 10;
            }
            $db = $this->conexion();
            $sql = "SELECT objeto.nombre, categoria.titulo as 'categoria', objeto.descripcion, objeto.precio, objeto.latitud, objeto.longitud, objeto.puntuacion_compra,objeto.puntuacion_comentarios, objeto.puntuacion_total ,objeto.foto1,objeto.foto2,objeto.foto3, objeto.id FROM objeto join categoria on objeto.id_categoria=categoria.id  where categoria.titulo like ('%$nombre%') Limit $pagina,$indice";
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
                $producto['foto1'] = $res[9];
                $producto['foto2'] = $res[10];
                $producto['foto3'] = $res[11];
                $producto['id'] = $res[12];



                $catalogo[$contador] = $producto;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getProductosPorPuntuacionTotal($pagina)
    {
        try {
            $pagina = $pagina * 10;
            $indice = 10;
            if ($pagina != 0) {

                $indice = $pagina + 10;
            }
            $db = $this->conexion();
            $sql = "SELECT objeto.nombre, categoria.titulo as 'categoria', objeto.descripcion, objeto.precio, objeto.latitud, objeto.longitud, objeto.puntuacion_compra,objeto.puntuacion_comentarios, objeto.puntuacion_total ,objeto.foto1,objeto.foto2,objeto.foto3, objeto.id FROM objeto join categoria on objeto.id_categoria=categoria.id ORDER by (objeto.puntuacion_comentarios+objeto.puntuacion_compra) desc Limit $pagina,$indice";
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
                $producto['foto1'] = $res[9];
                $producto['foto2'] = $res[10];
                $producto['foto3'] = $res[11];
                $producto['id'] = $res[12];



                $catalogo[$contador] = $producto;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getProductosPorVentas($pagina)
    {
        try {
            $pagina = $pagina * 10;
            $indice = 10;
            if ($pagina != 0) {

                $indice = $pagina + 10;
            }
            $db = $this->conexion();
            $sql = "SELECT objeto.nombre, categoria.titulo as 'categoria', objeto.descripcion, objeto.precio, objeto.latitud, objeto.longitud, objeto.puntuacion_compra,objeto.puntuacion_comentarios, objeto.puntuacion_total ,objeto.foto1,objeto.foto2,objeto.foto3, objeto.id FROM objeto join categoria on objeto.id_categoria=categoria.id ORDER by objeto.puntuacion_compra desc Limit $pagina,$indice";
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
                $producto['foto1'] = $res[9];
                $producto['foto2'] = $res[10];
                $producto['foto3'] = $res[11];
                $producto['id'] = $res[12];



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
                $comentarios['id'] = $res[4] . "_" . $res[5];




                $catalogo[$contador] = $comentarios;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getComprasUsuario($email){
        $datos=[];
        $datos[0]=$email;
        try {
           
            $db = $this->conexion();
            $sql = "SELECT objeto.nombre,fecha FROM compra join objeto on id_objeto=objeto.id WHERE id_usuario=(select id from usuario where email=?) order by fecha desc";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);


            $catalogo = [$stmt->rowCount()];
            $contador = 0;
            foreach ($stmt as $res) {

                $comentarios = [];
                $comentarios['nombre'] = $res[0];
                $comentarios['fecha'] = $res[1];
             
                




                $catalogo[$contador] = $comentarios;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }
    public function getComentariosUsuario($email){
        $datos=[];
        $datos[0]=$email;
        try {
           
            $db = $this->conexion();
            $sql = "SELECT objeto.nombre,fecha,comentario FROM comentario join objeto on id_objeto=objeto.id WHERE id_usuario=(select id from usuario where email=?) order by fecha desc";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);


            $catalogo = [$stmt->rowCount()];
            $contador = 0;
            foreach ($stmt as $res) {

                $comentarios = [];
                $comentarios['nombre'] = $res[0];
                $comentarios['fecha'] = $res[1];
                $comentarios['comentario'] = $res[2];
                




                $catalogo[$contador] = $comentarios;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }


    public function getComentariosObjeto($pagina,$idObjeto)
    {

        try {
            $pagina = $pagina * 3;
            $indice = 3;
            if ($pagina != 0) {

                $indice = $pagina + 3;
            }
            $db = $this->conexion();
            $sql = "select comentario from comentario where id_objeto=$idObjeto LIMIT $pagina,$indice ;";
            $stmt = $db->prepare($sql);
            $stmt->execute();


            $catalogo = [$stmt->rowCount()];
            $contador = 0;
            foreach ($stmt as $res) {

                $comentarios = [];
                $comentarios['comentario'] = $res[0];
               




                $catalogo[$contador] = $comentarios;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getComentarioUsuario($idObjeto,$email)
    {

        try {
           $datos=[];
           $datos[0]=$email;
           $datos[1]=$idObjeto;
            $db = $this->conexion();
            $sql = "SELECT comentario from comentario where id_usuario =(select id from usuario where email=?) and id_objeto=?";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);


            $catalogo = [$stmt->rowCount()];
            $contador = 0;
            foreach ($stmt as $res) {

                $comentarios = [];
                $comentarios['comentario'] = $res[0];
               




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

    public function getUsuarioPorEmail($email)
    {
    $datos=[];
    $datos[0]=$email;


        try {

            $db = $this->conexion();
            $sql = "SELECT id,nombre,apellidos,email,password,monedero from usuario where email=?";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);


            $catalogo = [$stmt->rowCount()];
            $contador = 0;
            foreach ($stmt as $res) {

                $categoria = [];
                $categoria['id'] = $res['id'];
                $categoria['nombre'] = $res['nombre'];
                $categoria['apellidos'] = $res['apellidos'];
                $categoria['email'] = $res['email'];
                $categoria['password'] = $res['password'];
                $categoria['monedero'] = $res['monedero'];


                $catalogo[$contador] = $categoria;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
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
            $sql = "SELECT categoria.titulo,categoria.descripcion, cat2.titulo as categoria_padre,categoria.foto,categoria.id FROM categoria left join categoria as cat2 on cat2.id=categoria.categoria_padre where categoria.id=$id";
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


    public function getComentario($id1, $id2)
    {
        $datos = [];
        $datos[0] = $id1;
        $datos[1] = $id2;
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
                $comentarios['id'] = $res[4] . "_" . $res[5];




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

        $consulta = "";
        if (sizeof($datos) == 6) {
            $consulta = "update  usuario set email=? , password=sha1(?) , nombre=? , apellidos=? , monedero=? where id=?";
        } elseif (sizeof($datos) == 2) {
            $consulta = "update  usuario set  foto=? where id=?";
        } else {
            $consulta = "update  usuario set email=? , password=sha1(?) , nombre=? , apellidos=? , monedero=? , foto=? where id=?";
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


        $consulta = "";
        if (sizeof($datos) == 4) {
            if ($datos[2] == 0) {
                $datos[2] = null;
            }
            $consulta = "update  categoria set   titulo=? , descripcion=? ,categoria_padre=?  where id=?";
        } elseif (sizeof($datos) == 2) {
            $consulta = "update  categoria set  foto=? where id=?";
        } else {
            if ($datos[2] == 0) {
                $datos[2] = null;
            }
            $consulta = "update  categoria set  titulo=? , descripcion=?  ,categoria_padre=?, foto=? where id=?";
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

    public function actualizar_imagen1_objetos($datos)
    {

        try {

            $db = $this->conexion();
            //insertamos el pedido
            $sql = "update  objeto set foto1=? where id=?";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);


            $db = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function actualizar_imagen2_objetos($datos)
    {

        try {

            $db = $this->conexion();
            //insertamos el pedido
            $sql = "update  objeto set foto2=? where id=?";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);


            $db = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function actualizar_imagen3_objetos($datos)
    {








        try {

            $db = $this->conexion();
            //insertamos el pedido
            $sql = "update  objeto set foto3=? where id=?";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);


            $db = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function actualizar_objetos($datos)
    {

        $consulta = "";

        $consulta = "update  objeto set   nombre=? , descripcion=? , precio=? , latitud=? , longitud=? , id_categoria=? where id=?";





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


    public function actualizar_comentario($datos)
    {




        try {


            $db = $this->conexion();
            //insertamos el pedido
            $sql = "update  comentario set comentario=?  where id_usuario=(select id from usuario where email=?) and id_objeto=?";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);


            $db = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    //delete from
    public function deleteUsuario($id)
    {


        try {

            $db = $this->conexion();
            $sql = "delete from usuario where id=?";
            $stmt = $db->prepare($sql);
            $stmt->execute($id);


         
            $db = null;
        
        } catch (PDOException $e) {
           return "No se pudo eliminar";
        }
    }
    public function deleteUsuarioPublico($email)
    {

        $datos=[];
        $datos[0]=$email;
        try {

            $db = $this->conexion();
            $sql = "delete from usuario where email=$email)";
            $stmt = $db->prepare($sql);
            $stmt->execute();


         
            $db = null;
        
        } catch (PDOException $e) {
           return "No se pudo eliminar";
        }
    }

    public function deleteCategoria($id)
    {


        try {

            $db = $this->conexion();
            $sql = "delete FROM categoria  where categoria.id=?";
            $stmt = $db->prepare($sql);
            $stmt->execute($id);


        
            $db = null;
        
        } catch (PDOException $e) {
            return "No se pudo eliminar";
        }
    }

    public function deleteProducto($id)
    {
        try {

            $db = $this->conexion();
            $sql = "delete from objeto where objeto.id=?";
            $stmt = $db->prepare($sql);
            $stmt->execute($id);


            $db = null;
           
        } catch (PDOException $e) {
            return "No se pudo eliminar";
        }
    }


    public function deleteComentario($datos)
    {
      
        try {

            $db = $this->conexion();
            $sql = "delete from comentario where id_usuario=? and id_objeto=?";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);

           
            $db = null;
           
        } catch (PDOException $e) {
            return "No se pudo eliminar";
        }
    }

    public function deleteComentarioUsuario($datos)
    {
      
        try {

            $db = $this->conexion();
            $sql = "delete from comentario where id_usuario=(select id from usuario where email=?) and id_objeto=?";
            $stmt = $db->prepare($sql);
            $stmt->execute($datos);

           
            $db = null;
           
        } catch (PDOException $e) {
            return "No se pudo eliminar";
        }
    }


}


?>