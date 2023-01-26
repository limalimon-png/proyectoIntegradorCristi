<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>chrismeta</title>
  <link rel="stylesheet" href="../templates/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../templates/assets/css/styles.min.css">
</head>

<body>
  <?php include('nav.php'); ?>
  <section class="py-4 py-xl-5 mb-5">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
          <h2>Perfil usuario</h2>
          <p>Bienvenido a tu perfil en CHRISTIE'S & META! Este es el lugar donde puedes ver todas tus compras, comentarios y modificar tu información personal.</p>
        </div>
      </div>
      <div class="row d-flex justify-content-center ">
        <div class="col-md-6 col-xl-4">
          <div class="card mb-5">
            <div class="card-body d-flex flex-column align-items-center">
              <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z">
                  </path>
                </svg></div>



              <form class="text-center" method="post" action="perfil/actualizar" onsubmit="return validarFormulario()">
                <div class="mb-3"><input class="form-control" type="text" name="nombre" id="nombre" placeholder="nombre" tipo="nombre"><div  class="invalid-feedback">Introduce un nombre correcto, solo letras</div></div>
                <div class="mb-3"><input class="form-control" type="text" name="apellidos" id="apellidos" placeholder="apellidos" tipo="apellido"><div id="" class="invalid-feedback">Utiliza solo letras. al menos 2 caracteres</div></div>
                <div class="mb-3"><input class="form-control" type="email" name="email" id="email" placeholder="Email" tipo="email"><div id="" class="invalid-feedback">Introduce un email válido</div></div>
                <div class="mb-3"><input class="form-control" type="password" name="pass" id="pass" placeholder="Password" tipo="password">
                <div  class="invalid-feedback">Debe tener al menos 8 caracteres, al menos una letra minúscula</div>

                  <input type="hidden" name="monedero" id="monedero" value="100">
                  <input type="hidden" name="id" id="id" value="">
                </div>
                <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Actualizar</button></div>

              </form>
            </div>
          </div>
        </div>

        <section id="compras">
          <h2 class="text-center mt-3 mb-3">Compras</h2>
          <table class="table" id="tablaCompra">
          
          </table>
        </section>
        <section id="comentarios">
          <h2 class="text-center mt-3 mb-3">Comentarios</h2>
          <table class="table" id="tablaComentario">
          
          </table>
        </section>

      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../templates/assets/js/script.min.js"></script>
  <script src="../templates/assets/js/perfil.js"></script>
  <script src="../templates/assets/js/validaciones.js"></script>
  <script>cargarDesdeOtroArchivo();</script>
</body>

</html>