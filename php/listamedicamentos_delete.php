<?php
	include("config.php");

	if($_POST["cantidad"] == 'todo')
		$query = "DELETE FROM `lista_medicamentos` WHERE `botiquin` = '".$_POST['botiquin']."' AND `medicamento` = '".$_POST['medicamento']."'";
	else{//Corregir trigger de actualizacion
		$consulta = "SELECT cantidad FROM lista_medicamentos WHERE `botiquin` = '".$_POST['botiquin']."' AND `medicamento` = '".$_POST['medicamento']."'";
		$resultado = $conexion->query($consulta);
    	$ret = mysqli_fetch_array($resultado);

		$query = "UPDATE `lista_medicamentos` SET `cantidad`=  '".$ret["cantidad"] - $_POST["cantidad"]."' WHERE `botiquin` = '".$_POST['botiquin']."' AND `medicamento` = '".$_POST['medicamento']."'";
	}

	mysqli_query( $conexion, $query ) or die ( "Algo ha ido mal en la consulta a la base de datos");
	mysqli_close( $conexion );
?>