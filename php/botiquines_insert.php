<?php
	include 'config.php';
	if($_POST["veterinario"] == 'null')
		$consulta = "INSERT INTO `tb_botiquin`(`descripcion`) VALUES ('".$_POST["descripcion"]."')";
	else
		$consulta = "INSERT INTO `tb_botiquin`(`descripcion`, veterinario) VALUES ('".$_POST["descripcion"]."', '".$_POST["veterinario"]."')";
	mysqli_query( $conexion, $consulta ) or die ( "ERROR");
	mysqli_close( $conexion);
?>
