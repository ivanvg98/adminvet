<?php 
	include("config.php"); // se inicia conexion a BD cin la configuracion dada
	if($_POST['opc'] == 'si'){
		$fechaProgramada = $_POST["fecha"]." ".$_POST["hora"]; 
		$query = "UPDATE `tb_consultas` SET `descripcion`= '".$_POST['descripcion']."',`prioridad`= 'PROGRAMADA', fechaProgramada = '".$fechaProgramada."' WHERE IDConsulta = '".$_POST['IDConsulta']."'";
	}
	else
		$query = "UPDATE `tb_consultas` SET `descripcion`= '".$_POST['descripcion']."',`prioridad`= '".$_POST['prioridad']."' WHERE IDConsulta = '".$_POST['IDConsulta']."'";

	mysqli_query( $conexion, $query ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	mysqli_close( $conexion ); // se cierra conexion a BD
?>