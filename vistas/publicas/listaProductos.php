<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    />
    <title>chrismeta</title>
    <link rel="stylesheet" href="../templates/assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../templates/assets/css/styles.min.css" />
  </head>
  <body>
  <?php include('nav.php')?>

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
        <li><a class="dropdown-item" onclick="cambiarPlaceHolder('Nombre producto')" >Nombre producto</a></li>
        <li><a class="dropdown-item" onclick="cambiarPlaceHolder('Nombre categoria')">Nombre categoria</a></li>
        <li><a class="dropdown-item" onclick="puntuacion()">Puntuacion total</a></li>
        <li><a class="dropdown-item"onclick="ventas()">Ventas</a></li>
        
      </ul>
    </div>
  </div>
  
  <div class="col-12 col-sm-9">
    <form class="d-flex" role="search" action="listaPorNombre" id="formularioProductos">
      
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
     
     
     
      <div class="accordion-item">
        <h2 class="accordion-header" role="tab">
          <button
            class="accordion-button collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#accordion-1 .item-1"
            aria-expanded="false"
            aria-controls="accordion-1 .item-1"
          >
          
          <div class="container-fluid row">
            <div class="col-3">
              <img class=""src="https://corporafruit.com/wp-content/uploads/2019/05/producto-img-1-1.png" style="max-height: 60px"/>

            </div>
            
            <div class="col-5">
              <h3>titulo</h3>
            </div>
            <div class="col-4">
              <h5>Precio: 31222</h5>
            </div>
            


            </div>
          </button>
        </h2>
        <div
          class="accordion-collapse collapse item-1"
          role="tabpanel"
          data-bs-parent="#accordion-1"
        >



        <!-- body -->
          <div class="accordion-body mb-4">

            <div class="container py-4 py-xl-5">

              <div class="row row-cols-1 row-cols-md-2">
                <div class="col">
                  <div class="row">

                    <div class="col-12">
                      <img class="rounded w-100 h-100 fit-cover"style="min-height: 300px"src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png"/>
                    </div>
                    <div class="col-12">
                      <button>
                        <img class=""src="https://corporafruit.com/wp-content/uploads/2019/05/producto-img-1-1.png" style="max-height: 60px"/>
    
                      </button>
                      <button>
                        <img class=""src="https://corporafruit.com/wp-content/uploads/2019/05/producto-img-1-1.png" style="max-height: 60px"/>
    
                      </button>
                      <button>
                        <img class=""src="https://corporafruit.com/wp-content/uploads/2019/05/producto-img-1-1.png" style="max-height: 60px"/>
    
                      </button>
                    </div>

                  </div>
                  
                 
                  
                  
                  
              </div>
                <div class="col d-flex flex-column justify-content-center p-4">
                  <div class="text-center text-md-start d-flex flex-column align-items-center align-items-md-start mb-5">
                   
                    <div>
                      <h4>Title</h4>
                      <p>
                        Erat netus est hendrerit, nullam et quis ad cras porttitor
                        iaculis. Bibendum vulputate cras aenean.
                      </p>
                      <button class="btn btn-primary" type="button">Comprar Ya</button>
                    </div>

                  </div>
                  
                  
                </div>



                
              </div>

              <div class="row">
                <div class="col-12 d-flex flex-column justify-content-center p-4">
                  <h2>Reseñas</h2>
                  <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Comenta este Producto</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    <div class=" justify-content-center w-100" role="group" aria-label="Basic outlined example">
                      <button type="button" class="btn btn-outline-primary">Comentar</button>
                      <button type="button" class="btn btn-outline-primary">Actualizar</button>
                      <button type="button" class="btn btn-outline-primary">Eliminar</button>
                    </div>
                  </div>
                </div>
                </div>

                <div class="container py-4 py-xl-5">
                  <div class="row mb-5">
                      <div class="col-md-8 col-xl-6 text-center mx-auto">
                          <h2>Reseñas de otros clientes</h2>
                      </div>
                  </div>
                  <div class="row gy-4 row-cols-1 row-cols-sm-2 row-cols-lg-3">
                      <div class="col">
                          <div>
                              <p class="bg-light border rounded border-0 border-light p-4">Nisi sit justo faucibus nec ornare amet, tortor torquent. Blandit class dapibus, aliquet morbi.</p>  
                          </div>
                      </div>
                      <div class="col">
                          <div>
                              <p class="bg-light border rounded border-0 border-light p-4">Nisi sit justo faucibus nec ornare amet, tortor torquent. Blandit class dapibus, aliquet morbi.</p>
                          </div>
                      </div>
                      <div class="col">
                          <div>
                              <p class="bg-light border rounded border-0 border-light p-4">Nisi sit justo faucibus nec ornare amet, tortor torquent. Blandit class dapibus, aliquet morbi.</p>
                          </div>
                      </div>

                     
                  </div>

                  <div class="row mb-5 mt-5">
                    <div class="col-md-8 col-xl-6 text-center mx-auto">
                      <button type="button" class="btn btn-primary">Mostrar más</button>
                    </div>
                </div>

              </div>
              </div>
            </div>

          </div>
        
      </div>
      









      <div class="accordion-item">
        <h2 class="accordion-header" role="tab">
          <button
            class="accordion-button collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#accordion-1 .item-2"
            aria-expanded="false"
            aria-controls="accordion-1 .item-2"
          >
            Accordion Item
          </button>
        </h2>
        <div
          class="accordion-collapse collapse item-2"
          role="tabpanel"
          data-bs-parent="#accordion-1"
        >
          <div class="accordion-body">
            <p class="mb-0">
              Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo
              odio, dapibus ac facilisis in, egestas eget quam. Donec id elit
              non mi porta gravida at eget metus.
            </p>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" role="tab">
          <button
            class="accordion-button collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#accordion-1 .item-3"
            aria-expanded="false"
            aria-controls="accordion-1 .item-3"
          >
            Accordion Item
          </button>
        </h2>
        <div
          class="accordion-collapse collapse item-3"
          role="tabpanel"
          data-bs-parent="#accordion-1"
        >
          <div class="accordion-body">
            <p class="mb-0">
              Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo
              odio, dapibus ac facilisis in, egestas eget quam. Donec id elit
              non mi porta gravida at eget metus.
            </p>
          </div>
        </div>
      </div>
    </div>



    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../templates/assets/js/script.min.js"></script>
    <script src="../templates/assets/js/filtrosListados.js"></script>
  </body>
</html>
