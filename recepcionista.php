<?php session_start(); 
	if(!isset($_SESSION["user"]))
		header("Location: index.php", true, 301);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta author="Azpeita Hernández Vladimir">
    <meta charset="UTF-8">
    <title>Inicio</title>
    <!-- Dependencias bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/sorttable.js"></script>
    <script type="text/javascript" src="js/clientes.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse">
		<!-- barra de navegacion estandar responsiva ancho 100% -->
		<div class="container-fluid">
            <div class="navbar-header">
             	<a class="navbar-brand" href="recepcionista.php"><span class="glyphicon glyphicon-home"></span> Inicio</a>
            </div>
			<ul class="nav navbar-nav">
				<li><a href="consultas.php">Consultas</a></li>
				<li><a href="clientes.php">Clientes</a></li>
				<li><a href="inventario.php">Inventario</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<!-- extremo derecho de la barra -->
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION['user_name'];?> <img src="img/usuario.png" class="img-circle" alt="Cinque Terre" width="25" height="25"></a>
				<ul class="dropdown-menu">
					<li><a href="user_opciones.php">Configuración</a></li>
					<li><a href="php/logout.php">Cerrar Sesión</a></li>
				</ul>
			</li>
		</ul>
		</div>
	</nav>  
	<div class="container">
		<h3>Bienvenido <b><?php echo $_SESSION['user_name'];?></b>, eres un usuario tipo <b><?php echo $_SESSION['tipo'];?></b></h3>
	</div>
</body>
</html>