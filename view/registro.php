

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
 if(isset($_POST["mensaje"]))
 echo $_POST["mensaje"];
    
    ?>

        <form  method="post" action="./registro/process" >
            <label for="">correo</label>
            <input type="text" name="user" id="">
            <br>
            <br>
            <label for="">clave</label>

            <input type="password" name="pass" id="">
            <br>
            <br>
            <label for="">Direccion</label>
            <input type="text" name="direc" id="">
            <br>
            <br>
            <input type="submit" value="enviar">
            
            
        </form>
        
    </div>
</body>
</html>