<?php 
	include("config.php"); // se inicia conexion a BD con la configuracion dada
	session_start();
	if($_SESSION["tipo"] == "ADMINISTRADOR")
		$query = "DELETE FROM `tb_consultas` WHERE `IDConsulta` = '".$_POST['IDConsulta']."'";
	else{
		$today = getdate();
		$current_date = $today["year"]."-".$today["mon"]."-".$today["mday"];
		$query = "INSERT INTO `tb_peticiones`(`empleado`, `table`, `meta`, `ID`, `fechaSolicitud`, `descripcion`) VALUES ('".$_SESSION['usr']."','tb_consultas','IDConsulta', '".$_POST['IDConsulta']."', '".$current_date."', '".$_POST["descripcion"]."');";
	}
	mysqli_query( $conexion, $query ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	mysqli_close( $conexion ); // se cierra conexion a BD
?>