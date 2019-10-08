<?php 
	include("config.php"); // se inicia conexion a BD con la configuracion dada
	$query = "DELETE FROM `tb_empleados` WHERE `user` = '".$_POST['user']."'";
	mysqli_query( $conexion, $query ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	mysqli_close( $conexion ); // se cierra conexion a BD
?>