
<?php
class Bd
{
    private $ultimoId;

    public function getPedido(){
        $pedido = file_get_contents('store');
        
        $this->ultimoId=unserialize($pedido);
        return $this->ultimoId;
    }
    public static function conexion()
    {

        return new PDO('mysql:host=localhost;dbname=practica12', 'root', '');
    }


    public function getCategorias()
    {
        try {

            $db = $this->conexion();
            $sql = "SELECT * FROM categoria";
            $stmt = $db->prepare($sql);
            $stmt->execute();


            $catalogo = [$stmt->rowCount()];
            $contador = 0;
            foreach ($stmt as $res) {

                $categoria = [];
                $categoria[0] = $res["nombre"];
                $categoria[1] = $res["codCat"];
                $categoria[2] = $res["descripcion"];


                $catalogo[$contador] = $categoria;
                $contador++;
            }
            $db = null;
            return $catalogo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
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


    public function getProductos($cod)
    {
        try {

            $db = $this->conexion();
            $sql = "SELECT * FROM producto where sha1(codCat)=?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($cod));


            $catalogo = [$stmt->rowCount()];
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


    public function procesarPedidos ($codRes){
        
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
            $pedido=serialize($this->ultimoId);
            file_put_contents('store', $pedido);

            $db = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    

    }

    public function pedidoEnviado (){
        
       $array[0]=$this->ultimoId;

        
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



    public function resetearPass($email,$pass):bool
    {

        try {

            $db = $this->conexion();
            $sql = "SELECT codRes FROM restaurante where sha1(correo)=?";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($email));

            $id=0;
            $contador = 0;
            foreach ($stmt as $res) {

                
                $id = $res["codRes"];
               


                
                $contador++;
            }
            $db = null;


            if($contador==1){


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
}


?>