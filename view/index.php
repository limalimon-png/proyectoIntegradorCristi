<html>
<head>
<!-- <base href="./view/" /> -->
<base href="/iescomercio/dwes/proyectos/mvc/mvc/view/" />
<!--<base href="<?php echo dirname($_SERVER['PHP_SELF']);?>/view/" />-->

<style>
    th{
        width: 8rem;
        text-align: left;
        border-bottom: 1px solid black;
    }
    td{
        width: 8rem;
    }
</style>
</head>
<body>
<h1>Ejemplo 5: Listado de coches</h1>
<table>
    <tr>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Color</th>
        <th>Propietario</th>
        <th>Foto Absoluta</th>
        <th>Foto Relativa</th>
    </tr>
    <?php foreach ($rowset as $row){ ?>

        <tr>
            <td><?php echo $row->getMarca(); ?></td>
            <td><?php echo $row->getModelo(); ?></td>
            <td><?php echo $row->getColor(); ?></td>
            <td><?php echo $row->getPropietario(); ?></td>
            <td><img src="<?php echo $ruta; ?>view/fotos/<?php echo $row->getFoto(); ?>" width="30%"/></td>
            <td><img src="fotos/<?php echo $row->getFoto(); ?>" width="30%"/></td>
        </tr>

     <?php } ?>
</table>
</body>
</html>