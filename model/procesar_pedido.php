<?php


class Procesar
{
private $valido;


public function getValido(){
    return $this->valido;
}

    public function __construct()
    {

        if (isset($_SESSION['carrito'])) {

            if (!empty($_SESSION['carrito'])) {

                $bd = new Bd();

                $carrito = $_SESSION['carrito'];
                $codRes = $_SESSION['credenciales'][1];


                $bd->procesarPedidos($codRes);

                foreach ($carrito as $key => $value) {

                    $bd->procesarDetallePedidos($value, $key);
                }
                $_SESSION['carrito'] = [];
                $this->valido=true;
                
            }else{
                $this->valido=false;
            }
        }
    }
}
