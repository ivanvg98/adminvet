<?php 
	include("config.php"); // se inicia conexion a BD cin la configuracion dada
	$query = "UPDATE `tb_clientes` SET `nombre`= '".$_POST['nombre']."',`apodos`= '".$_POST['apodos']."',`telefono`= '".$_POST['telefono']."',`direccion`= '".$_POST['direccion']."',`referencias`= '".$_POST['referencias']."' WHERE `IDCliente` = '".$_POST['IDCliente']."'";
	mysqli_query( $conexion, $query ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	mysqli_close( $conexion ); // se cierra conexion a BD
?>