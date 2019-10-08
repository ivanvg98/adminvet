<?php 
	include("config.php"); // se inicia conexion a BD con la configuracion dada
	session_start();
	if($_SESSION["tipo"] == "ADMINISTRADOR")
		$query = "DELETE FROM `tb_inventario` WHERE `codigo` = '".$_POST['codigo']."'";
	mysqli_query( $conexion, $query ) or die ( "ERROR");
	mysqli_close( $conexion ); // se cierra conexion a BD
?>