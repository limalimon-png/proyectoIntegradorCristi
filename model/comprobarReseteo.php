<?php 

class Reseteo{
    private $res;
    public function __construct()
    {
        if (isset($_POST["password"]) && isset($_POST["email"])) {

          
            if(!empty($_POST["password"])){
                $bd=new Bd();
                $this->res=$bd->resetearPass($_POST["email"],sha1($_POST["password"]));


            }

        }
    }


    
    public function getResulado()
    {
       return $this->res;
    }
}


?>