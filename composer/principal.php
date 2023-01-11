<?php 




require "mailer.php";

use mail\Mailer;
$mail= new Mailer();




$mail->enviarEmail('guillermomartinez1222@gmail.com',"",
'guillermomartinez1222@gmail.com',
"gomzra@gmail.com");
?>