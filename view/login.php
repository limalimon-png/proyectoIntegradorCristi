

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div style="margin:auto; text-align: center; margin-top: 15%;">

    <?php 
   
     echo $this->mensaje;
    
    ?>

        <form  method="post" action="./login/process" >
            <label for="">correo</label>
            <input type="text" name="user" id="">
            <br>
            <br>
            <label for="">clave</label>

            <input type="password" name="pass" id="">
            <br>
            <br>
            <input type="submit" value="enviar">
            
            
        </form>

    <br>
    <br>
        <a href="./registro">Registrarse</a>
        <br>
        <a href="./password/recordar/formulario ">Resetear contraseña</a>
        
    </div>
</body>
</html>