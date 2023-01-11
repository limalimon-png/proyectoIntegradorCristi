


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Lista de categorías</h1>

<?php 




if($this->cats==null){
header("location:./categorias");
}else{
foreach ($this->cats as $value) {
    echo "<li>";
    echo   " <a href='./categorias/".sha1($value[1])."'>$value[0]</a> ";
    
echo "</li>";

}

}


?>


 
</body>
</html>