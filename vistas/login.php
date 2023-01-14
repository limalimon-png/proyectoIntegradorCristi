
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <base href="../index.php">
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

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../templates/assets/css/login.css">


</head>

<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="images/logo.png" alt="">
                    </a>
                </div>
                <div class="login-form">
                    
                    <form action="admin/login/process" method="POST"  >
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="user" class="form-control" placeholder="Email">
                        </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="pass" class="form-control" placeholder="Password">
                        </div>
                                <div class="checkbox">
                                    <label>
                                <input type="checkbox"> Remember Me
                            </label>
                                    <label class="pull-right">
                                <a href="admin/forget">Forgotten Password?</a>
                            </label>

                                </div>
                                <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>

                                <div class="register-link m-t-15 text-center">
                                    <p>Don't have account ? <a href="register.html"> Sign Up Here</a></p>
                                </div>
                    </form>
                </div>
                <br>
                <br>
                <div class="alert alert-danger" role="alert">
                    usuario o contraseña incorrecta
                </div>
            </div>
        </div>
    </div>


    <script src="../templates/vendors/jquery/dist/jquery.min.js"></script>
    <script src="../templates/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../templates/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../templates/assets/js/main.js"></script>


</body>

</html>

