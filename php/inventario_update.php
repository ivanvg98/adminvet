<?php 
	include("config.php"); // se inicia conexion a BD cin la configuracion dada
	$query = "UPDATE `tb_inventario` SET `codigo`='".$_POST["codigo"]."',`nombre`='".$_POST["nombre"]."',`marca`='".$_POST["marca"]."',`descripcion`='".$_POST["descripcion"]."',`tipo`='".$_POST["tipo"]."',`precioUnitario`='".$_POST["precioUnitario"]."',`precioPublico`='".$_POST["precioPublico"]."',`cantidadDisponible`='".$_POST["cantidadDisponible"]."' WHERE `codigo` = '".$_POST['codigo']."'";
	mysqli_query( $conexion, $query ) or die ( "ERROR");
	mysqli_close( $conexion ); // se cierra conexion a BD
?>