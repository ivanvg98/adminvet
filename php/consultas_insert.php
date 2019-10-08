<?php
	include 'config.php';
	session_start();

	if($_POST['opc'] == 'si'){
		$fechaProgramada = $_POST["fecha"]." ".$_POST["hora"]; 
		$consulta = "INSERT INTO `tb_consultas` (`IDCliente`, `descripcion`, `fechaProgramada`, `estado`, `cuentaTotal`, cuentaPagada, prioridad, recepcionista) VALUES ('".$_POST['IDCliente']."', '".$_POST['descripcion']."', '".$fechaProgramada."', '0', '0', 0, '3', '".$_SESSION["user"]."');";
	}else{
		$consulta = "INSERT INTO `tb_consultas` (`IDCliente`, `descripcion`, `estado`, `cuentaTotal`, cuentaPagada, prioridad, recepcionista) VALUES ('".$_POST['IDCliente']."', '".$_POST['descripcion']."', 0, 0, 0, ".$_POST['prioridad'].", '".$_SESSION["user"]."');";
	}
	echo $consulta;
	mysqli_query( $conexion, $consulta ) or die ( "ERROR");
	mysqli_close( $conexion );
?>
