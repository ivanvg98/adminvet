<?php
	include 'config.php';
	$consulta = "INSERT INTO `tb_inventario`(`codigo`, `nombre`, `marca`, `descripcion`, `tipo`, `precioUnitario`, `precioPublico`, `cantidadDisponible`) VALUES ('".$_POST["codigo"]."','".$_POST["nombre"]."','".$_POST["marca"]."','".$_POST["descripcion"]."','".$_POST["tipo"]."','".$_POST["precioUnitario"]."','".$_POST["precioPublico"]."','".$_POST["cantidadDisponible"]."')";
	mysqli_query( $conexion, $consulta ) or die ( "ERROR");
	mysqli_close( $conexion );
?>
