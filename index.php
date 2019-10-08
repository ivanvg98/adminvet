<?php session_start(); 
    if(isset($_SESSION["tipo"]))
        if ($_SESSION["tipo"] == "ADMINISTRADOR")
            header("Location: admin.php", true, 301);
        else if($_SESSION["tipo"] == "VETERINARIO")
            header("Location: veterinario.php", true, 301);
        else if($_SESSION["tipo"] == "RECEPCIONISTA")
            header("Location: recepcionista.php", true, 301);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Azpeitia Hernández Vladimir">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Iniciar Sesión</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="js/my-login.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/my-login.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <img src="img/usuario.png" alt="logo">
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title">Iniciar Sesión</h4>
                            <form method="POST" class="my-login-validation" action="php/login.php">
                                <div class="form-group">
                                    <label for="user">Nombre de usuario</label>
                                    <input id="user" type="text" class="form-control" name="user" value="" required autofocus>
                                    <div class="invalid-feedback">
                                        Usuario incorrecto
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="pwd">Contraseña</label>
                                    <input id="pwd" type="password" class="form-control" name="pwd" required data-eye>
                                    <div class="invalid-feedback">
                                        Contraseña incorrecta
                                    </div>
                                </div>

<!--    CHECKOUT PARA SALVAR CONTRASEÑA                            
                                <div class="form-group">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" name="remember" id="remember" class="custom-control-input">
                                        <label for="remember" class="custom-control-label">Recuerdame</label>
                                    </div>
                                </div>
-->
                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Iniciar Sesión
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="footer">
                        Copyright &copy; 2019 &mdash; Veterinaria Pony
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
