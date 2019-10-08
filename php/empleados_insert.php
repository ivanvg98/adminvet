<?php
	include 'config.php';
	$consulta = "INSERT INTO `tb_empleados` (`user`, password, `nombre`, `telefono`, `tipo`) VALUES ('".$_POST['user']."', '".$_POST['password']."', '".$_POST['nombre']."', '".$_POST['telefono']."', '".$_POST['tipo']."');";
	mysqli_query( $conexion, $consulta ) or die ( "ERROR");
	mysqli_close( $conexion );
?>
