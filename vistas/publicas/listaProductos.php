<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <title>chrismeta</title>
  <link rel="stylesheet" href="../templates/assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../templates/assets/css/styles.min.css" />
</head>

<body>
  <?php include('nav.php') ?>

  <!-- buscador -->
  <!-- <div class="input-group">
  <div class="form-outline">
    <input type="search" id="form1" class="form-control" />
    <label class="form-label" for="form1">Search</label>
  </div>
  <button type="button" class="btn btn-primary">
    <i class="fas fa-search"></i>
  </button>
</div> -->

  <!-- filtros y buscador -->

  <section id="filtros" class="mt-5">

    <div class="container ">

      <div class="row">

        <div class="col-12  col-sm-3 order-last mt-3 mt-sm-0 " style="text-align: end;">
          <div class="btn-group">
            <button type="button" class="btn btn-outline-primary dropdown-toggle  me-2" data-bs-toggle="dropdown" aria-expanded="false">
              Filtros
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" onclick="cambiarPlaceHolder('Nombre producto')">Nombre producto</a></li>
              <li><a class="dropdown-item" onclick="cambiarPlaceHolder('Nombre categoria')">Nombre categoria</a></li>
              <li><a class="dropdown-item" onclick="puntuacion()">Puntuacion total</a></li>
              <li><a class="dropdown-item" onclick="ventas()">Ventas</a></li>

            </ul>
          </div>
        </div>

        <div class="col-12 col-sm-9">
          <form class="d-flex" role="search" id="formularioProductos" onsubmit="buscar(event)">

            <input class="form-control me-2" type="search" placeholder="Nombre producto" aria-label="Search" id="buscadorListadoProductos">
            <button class="btn btn-outline-primary" type="submit">Search</button>
          </form>
        </div>
      </div>
    </div>

  </section>
  <!-- acordeon -->
  <div class="mx-auto" style="height: 100px;">
  </div>
  <div class="accordion container" role="tablist" id="accordion-1">

  </div>

  <div id="cargarMas" class="mt-3 container" style="text-align: end;">
    <button type="button" class="btn btn-primary" onclick="cargarMas()">Cargar mas</button>
  </div>


<footer style="height: 100px;">

</footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../templates/assets/js/script.min.js"></script>
  <script src="../templates/assets/js/filtrosListadoProducto.js"></script>
</body>

</html>