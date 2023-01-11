

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
   
    // echo $_POST["mensaje"];
echo "
    

        <form  method='post' action='./formulario/process' >
            <label for=''>contraseña nueva</label>
            <input type='password' name='password' id=''>
            <input type='hidden' name='email' id='' value='".$_GET['id']."' >
         
            <br>
            <br>
            <input type='submit' value='enviar'>
            
            
        </form>
        ";
?>
   
    </div>
    
</body>
</html>