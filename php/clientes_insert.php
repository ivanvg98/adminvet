<?php
	include 'config.php';
	$consulta = "INSERT INTO `tb_clientes` (`nombre`, apodos, `telefono`, `direccion`, `referencias`) VALUES ('".$_POST['nombre']."', '".$_POST['apodos']."', '".$_POST['telefono']."', '".$_POST['direccion']."', '".$_POST['referencias']."');";

	$query = "SELECT * FROM `tb_clientes` WHERE nombre = '".$_POST['nombre']."' AND apodos = '".$_POST['apodos']."' AND telefono = '".$_POST['telefono']."' AND direccion = '".$_POST['direccion']."' AND referencias = '".$_POST['referencias']."'";
	mysqli_query( $conexion, $consulta ) or die ( "ERROR");
	$resultado = $conexion->query($query);
    $ret = mysqli_fetch_array($resultado);
	echo $ret['IDCliente'];
	mysqli_close( $conexion);
?>
