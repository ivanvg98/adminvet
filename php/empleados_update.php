<?php 
	include("config.php"); // se inicia conexion a BD cin la configuracion dada
	if($_POST["opc"] == "NO")
		$query = "UPDATE `tb_empleados` SET `nombre`= '".$_POST['nombre']."',`tipo`= '".$_POST['tipo']."',`telefono`= '".$_POST['telefono']."' WHERE `user` = '".$_POST['user']."'";
	else if($_POST["opc"] == "SI")
		$query = "UPDATE `tb_empleados` SET `nombre`= '".$_POST['nombre']."',`tipo`= '".$_POST['tipo']."',`telefono`= '".$_POST['telefono']."', password = '".$_POST["password"]."' WHERE `user` = '".$_POST['user']."'";
	mysqli_query( $conexion, $query ) or die ( "ERROR");
	mysqli_close( $conexion ); // se cierra conexion a BD
?>