<?php
	include 'config.php';
	$query = "SELECT COUNT(1) AS aux, cantidad FROM lista_medicamentos WHERE botiquin = '".$_POST["botiquin"]."' AND medicamento = '".$_POST["medicamento"]."'";
	$resultado = $conexion->query($query);
    $ret = mysqli_fetch_array($resultado);

    if($ret["aux"] == '0')
		$consulta = "INSERT INTO `lista_medicamentos`(`botiquin`, `medicamento`, `cantidad`) VALUES ('".$_POST["botiquin"]."', '".$_POST["medicamento"]."', '".$_POST["cantidad"]."')";
	else if($ret["aux"] == '1')
		$consulta = "UPDATE lista_medicamentos SET cantidad = '".($ret["cantidad"] + $_POST["cantidad"])."' WHERE botiquin = '".$_POST["botiquin"]."' AND medicamento = '".$_POST["medicamento"]."' ";
	mysqli_query( $conexion, $consulta ) or die ( "ERROR");
	mysqli_close( $conexion );
?>
