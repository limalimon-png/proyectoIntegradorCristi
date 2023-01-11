<?php 

/**
 * 
 * @author raulbonachia
 *
 */
class Car {
    
    //Atributos
    var $marca;
    var $modelo;
    var $color;
    var $propietario;
    var $foto;

    /**
     * 
     * @param string $miMarca
     * @param string $miModelo
     * @param string $miColor
     * @param string $miPropietario
     */
    function __construct($miMarca,$miModelo,$miColor,$miPropietario, $foto){

        $this->marca = $miMarca;
        $this->modelo = $miModelo;
        $this->color = $miColor;
        $this->propietario = $miPropietario;
        $this->foto = $foto;
    }
    
    /**
     * 
     * @param string $miMarca
     */
    function setMarca($miMarca){

        $this->marca = $miMarca;

    }
    
    /**
     * 
     * @return string
     */
    function getMarca(){
        return $this->marca;
    }

    /**
     * 
     * @param string $miModelo
     */
    function setModelo($miModelo){
        $this->modelo = $miModelo;
    }

    /**
     * 
     * @return string
     */
    function getModelo(){
       return $this->modelo;
    }
    
    /**
     * 
     * @param string $miColor
     */
    function setColor($miColor){
        $this->color = $miColor;
    }

    /**
     * 
     * @return string
     */
    function getColor(){
        return $this->color;
    }

    /**
     * 
     * @param string $miPropietario
     */
    function setPropietario($miPropietario){
        $this->propietario = $miPropietario;
    }

    /**
     * 
     * @return string
     */
    function getPropietario(){
        return $this->propietario;
    }
    
    /**
     *
     * @param string $foto
     */
    function setFoto($foto){
        $this->foto = $foto;
    }
    
    /**
     *
     * @return string
     */
    function getFoto(){
        return $this->foto;
    }
    
    
}

?>