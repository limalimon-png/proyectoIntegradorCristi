<?php



class Sesion
{

    private $mensaje;
    function __construct()
    {
    }


    function getMensaje()
    {
        return $this->mensaje;
    }


    public function login($user)
    {
        $_POST["mensaje"] = 'usuario y contraseña incorrectos';
        $this->mensaje = 'usuario y contraseña incorrectos';
        if (isset($user[0]) && isset($user[1])) {
            $user[1] = sha1($user[1]);

            $resultado = $this->comporbarUsuario($user);

            if ($resultado[0]) {
                $user[1] = $resultado[1];
                session_start();
                $_SESSION['credenciales'] = $user;
                $this->mensaje = 'correcto';
            } else {
                $this->mensaje = 'usuario y contraseña incorrectos';
            }
        } else {

            $this->mensaje = 'usuario y contraseña incorrectos';
        }
    }



    public function loginPublico($user)
    {
        $_POST["mensaje"] = 'usuario y contraseña incorrectos';
        $this->mensaje = 'usuario y contraseña incorrectos';
        if (isset($user[0]) && isset($user[1])) {
            $user[1] = sha1($user[1]);

            $resultado = $this->comporbarUsuario($user);

            if ($resultado[0]) {
                $user[1] = $resultado[1];
                session_start();
                $_SESSION['credencialesPublicas'] = $user;
                $this->mensaje = 'correcto';
            } else {
                $this->mensaje = 'usuario y contraseña incorrectos';
            }
        } else {

            $this->mensaje = 'usuario y contraseña incorrectos';
        }
    }

    public function registro($user)
    {

        if (isset($user[0]) && isset($user[1]) && isset($user[2])) {
            $user[1] = sha1($user[1]);

            $resultado = $this->comporbarUsuario($user);

            if ($resultado[0]) {
                $this->mensaje = 'usuario ya existente';
            } else {
                $resultado[0] = false;
                try {
                    $db = Bd::conexion();

                    $sql = "insert into  restaurante (correo,clave,direccion) values (?,?,?) ";
                    $stmt = $db->prepare($sql);
                    $stmt->execute($user);
                    $db = null;
                    session_start();
                    $_SESSION['credenciales'] = $user;
                    $this->mensaje = "correcto";
                    $_POST["mensaje"] = "";
                } catch (PDOException $e) {
                    // echo $e->getMessage();
                    $this->mensaje = "usuario ya existente";
                }
            }
        } else {

            $this->mensaje = 'usuario y contraseña incorrectos';
        }
    }


    function comporbarUsuario($user)
    {

        try {
            $db = Bd::conexion();

            $sql = "select email,password from usuario where email=? and password=?; ";
            $stmt = $db->prepare($sql);
            $stmt->execute($user);




            $resultado[0] = false;
            foreach ($stmt as $res) {


                if ($user[0] == $res['email'] && $user[1] == $res['password']) {
                    $resultado = [true, 8];
                }
            }


            $db = null;
            return $resultado;
        } catch (PDOException $e) {
            // echo $e->getMessage();
            $resultado[0] = false;
            return $resultado;
        }
    }
}
