<?php 





echo "<h3>Pedido realizado con éxito,  se enviará un correo de confirmacion a: ".$this->body."</h3>
<p>a)confirmacion del pedido</p>
<br>
<a href='./logout'>Cerrar sesion</a><br><br>
<a href='./categorias'>ir a la home</a>";

unlink("store");



?>