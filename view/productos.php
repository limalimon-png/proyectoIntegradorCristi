<?php


        foreach ($this->categoria as $value) {
            echo "<h1>$value[0]</h1> <p>$value[1]</p><table>";
        }


        echo "<tr>

          <th>Nombre</th>
          <th>Descripción</th>
          <th>Peso</th>
          <th>Stock</th>
          <th colspan=2 >comprar</th>
      </tr>";
        foreach ($this->productos as $value) {
            echo "<tr>";
            echo "  <form action='../carrito/agregar' method='post'>";
            echo "<td>$value[0]</td>";
            echo "<td>$value[1]</td>";
            echo "<td>$value[2]</td>";
            echo "<td>$value[3]</td>";
            echo "<td><input type='number' name='unidades' min='1' value='1' ></td>";
            echo "<td>   <input type='submit' value='añadir'></td>";
            echo "<input type='hidden' name='cod' value='$value[4]'>";
            echo "<input type='hidden' name='cat' value='$this->cat'>";
            echo "</form>";
            echo "</tr>";
        }

        echo "</table>";
    
   

 