

<?php 
 if(session_status()!=2)
 session_start();
if (isset($_SESSION["credenciales"])) {
 if (empty($_SESSION["credenciales"])) {
     header('location:../login');
  
 } else {
    
   
 }
 
} else {
  
 header('location:../login');

}


?><!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <base href="../../index.php">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="../templates/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../templates/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../templates/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../templates/vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="../templates/assets/css/style.css">

    <!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'> -->



</head>

<body>
    <!-- Left Panel -->
    <?php
    include('menuLateral.php')

    ?>
    <!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">5</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                                <a class="dropdown-item media bg-flat-color-4" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>Server #2 overloaded.</p>
                                </a>
                                <a class="dropdown-item media bg-flat-color-5" href="#">
                                    <i class="fa fa-warning"></i>
                                    <p>Server #3 overloaded.</p>
                                </a>
                            </div>
                        </div>

                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-email"></i>
                                <span class="count bg-primary">9</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">You have 4 Mails</p>
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                                    <span class="message media-body">
                                        <span class="name float-left">Jonathan Smith</span>
                                        <span class="time float-right">Just now</span>
                                        <p>Hello, this is an example msg</p>
                                    </span>
                                </a>
                                <a class="dropdown-item media bg-flat-color-4" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/2.jpg"></span>
                                    <span class="message media-body">
                                        <span class="name float-left">Jack Sanders</span>
                                        <span class="time float-right">5 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </span>
                                </a>
                                <a class="dropdown-item media bg-flat-color-5" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/3.jpg"></span>
                                    <span class="message media-body">
                                        <span class="name float-left">Cheryl Wheeler</span>
                                        <span class="time float-right">10 minutes ago</span>
                                        <p>Hello, this is an example msg</p>
                                    </span>
                                </a>
                                <a class="dropdown-item media bg-flat-color-3" href="#">
                                    <span class="photo media-left"><img alt="avatar" src="images/avatar/4.jpg"></span>
                                    <span class="message media-body">
                                        <span class="name float-left">Rachel Santos</span>
                                        <span class="time float-right">15 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa-user"></i> Notifications <span class="count">13</span></a>

                            <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a>

                            <a class="nav-link" href="#"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>

                    <div class="language-select dropdown" id="language-select">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="language" aria-haspopup="true" aria-expanded="true">
                            <i class="flag-icon flag-icon-us"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="language">
                            <div class="dropdown-item">
                                <span class="flag-icon flag-icon-fr"></span>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-es"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-us"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-it"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Forms</a></li>
                            <li class="active">Basic</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>










        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">


                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-header">
                                <strong>Basic Form</strong> Elements
                            </div>
                            <div class="card-body card-block">
                                <form action="admin/productos/alta" method="post" enctype="multipart/form-data" class="form-horizontal">

                                    <div class="row form-group">


                                        <div class="col col-md-3">
                                            <label for="" class="form-control-label">Imágenes</label>
                                        </div>

                                        <div class="col-12 col-md-9">
                                            <label for="img" class=" form-control-label">
                                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" id="img-preview1" src="../templates/images/noImage.png">
                                            </label>
                                            <label for="img2" class=" form-control-label">
                                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" id="img-preview2" src="../templates/images/noImage.png">
                                            </label>
                                            <label for="img3" class=" form-control-label">
                                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" id="img-preview3" src="../templates/images/noImage.png">
                                            </label>

                                            <div class="col-12 col-md-9"><input type="file" id="img" name="img" accept="image/*" class=" form-control-file" hidden></div>
                                            <div class="col-12 col-md-9"><input type="file" id="img2" name="img2" accept="image/*" class=" form-control-file" hidden></div>
                                            <div class="col-12 col-md-9"><input type="file" id="img3" name="img3" accept="image/*" class=" form-control-file" hidden></div>
                                            <small class="form-text text-muted">Haz click en las imagenes para cambiarlas</small>
                                        </div>
                                    </div>



                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="id-preview" class=" form-control-label">Id</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="id-preview" name="id-preview" placeholder="Disabled" disabled="" class="form-control"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="categoria" class=" form-control-label">Categoria</label></div>
                                        <div class="col-12 col-md-9">

                                           
                                                <select name="categoria" id="categoria" class="form-control" >
                                                    <option value="0">Seleccionar</option>
                                                   
                                                </select>
                                            

                                            <small class="form-text text-muted">This is a help text</small>
                                        </div>




                                    </div>

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="nombre" class=" form-control-label">Nombre</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="nombre" name="nombre" placeholder="Text" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="descripcion" class=" form-control-label">Descripcion</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="descripcion" name="descripcion" placeholder="Text" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="precio" class=" form-control-label">Precio</label></div>
                                        <div class="col-12 col-md-9"><input type="number" id="precio" name="precio" placeholder="Text" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                                    </div>
                                    
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="latitud" class=" form-control-label">latitud</label></div>
                                        <div class="col-12 col-md-9"><input type="number" id="latitud" name="latitud" placeholder="Text" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                                    </div>
                                    
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="longitud" class=" form-control-label">longitud</label></div>
                                        <div class="col-12 col-md-9"><input type="number" id="longitud" name="longitud" placeholder="Text" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                                    </div>
                                    
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="puntuacion_compra" class=" form-control-label">Puntuación compra</label></div>
                                        <div class="col-12 col-md-9"><input type="number" id="puntuacion_compra" name="puntuacion_compra" placeholder="Text" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                                    </div>
                                    
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="puntuacion_comentarios" class=" form-control-label">Puntuación reseña</label></div>
                                        <div class="col-12 col-md-9"><input type="number" id="puntuacion_comentarios" name="puntuacion_comentarios" placeholder="Text" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="puntuacion_total" class=" form-control-label">Puntuación total</label></div>
                                        <div class="col-12 col-md-9"><input type="number" id="puntuacion_total" name="puntuacion_total" placeholder="Text" class="form-control"><small class="form-text text-muted">This is a help text</small></div>
                                    </div>
                                    
                                    
                                  

                                    <input type="hidden" name="id" id="id">
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Guardar
                                        </button>
                                        <button type="reset" class="btn btn-danger btn-sm">
                                            <i class="fa fa-ban"></i> Limpiar
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-sm" onclick="volver()">
                                            <i class="fa fa-arrow-circle-o-left"></i> Volver
                                        </button>
                                        
                                    
                                    </div>


                                </form>


                            </div>

                        </div><!-- .content -->
                    </div><!-- /#right-panel -->
                    <!-- Right Panel -->


                    <script src="../templates/vendors/jquery/dist/jquery.min.js"></script>
                    <script src="../templates/vendors/popper.js/dist/umd/popper.min.js"></script>

                    <script src="../templates/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
                    <!-- <script src="../templates/vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js"></script> -->

                    <script src="../templates/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
                    <script src="../templates/assets/js/main.js"></script>
                    <script src="../templates/assets/js/fichaObjetos.js"></script>
</body>

</html>