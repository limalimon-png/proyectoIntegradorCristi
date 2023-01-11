<?php







echo "<h1>Carrito de la compra</h1> <table>";
echo "<tr>

<th>Nombre</th>
<th>Descripción</th>
<th>Peso</th>
<th>Stock</th>
<th colspan=2 >eliminar</th>
</tr>";



        foreach ($this->productosCarrito as $value) {
            echo "<tr>";
            echo "  <form action='./carrito/actualizar' method='post'>";
            echo "<td>$value[0]</td>";
            echo "<td>$value[1]</td>";
            echo "<td>$value[2]</td>";
            $unidades = $value[4];
            echo "<td>$carrito[$unidades]</td>";
            echo "<td><input type='number' name='unidades' min='1' value='1' ></td>";
            echo "<td>   <input type='submit' value='eliminar'></td>";
            echo "<input type='hidden' name='cod' value='$value[4]'>";
            echo "</form>";
            echo "</tr>";
        }


        echo "</table>";

        echo "<a href='pedido'>Realizar pedido</a>
        <br>
        <p>d) Carrito de la compra</p>";

    

