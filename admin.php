<?php 
	/*Verificamos que exista una sesion; en caso de que no, se redireccionara 
		al usuario a la pagina de inicio de sesion*/
	session_start(); 
	if(!isset($_SESSION["tipo"])) 
		header("Location: index.php", true, 301);
	else if ($_SESSION["tipo"] != "ADMINISTRADOR")
		header("Location: consultas.php", true, 301);  
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta author="Azpeita Hernández Vladimir">
    <meta charset="UTF-8">
    <title>Inicio</title>

    <!-- Dependencias bootstrap  y script externos -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/sorttable.js"></script>    
    
    <!-- Scripts de la aplicacion -->
    <script type="text/javascript" src="js/general.js"></script>

    <!-- Hojas de estito -->
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
	<!-- Barra de navegacion superior -->
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<!-- extremo izquierdo de la barra -->
            <div class="navbar-header">
				<a class="navbar-brand active" href=""><span class="glyphicon glyphicon-home"></span> Inicio </a>
            </div>
			<ul class="nav navbar-nav">
				<li><a href="consultas.php">Consultas</a></li>
				<li><a href="clientes.php">Clientes</a></li>
				<li><a href="inventario.php">Inventario</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<!-- extremo derecho de la barra -->
			<li class="dropdown"><a  class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="img/usuario.png" class="img-circle" alt="Cinque Terre"></a>
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