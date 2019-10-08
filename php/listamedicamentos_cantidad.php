<?php
    if(isset($_POST["botiquin"]) && $_POST["botiquin"] != '' && isset($_POST["medicamento"]) && $_POST["medicamento"] != ''){
    	include("config.php"); // se acre la conexion a la BD con la configuracion dada

		$query = "SELECT botiquin, medicamento, cantidad FROM `lista_medicamentos` WHERE botiquin = '".$_POST["botiquin"]."' AND medicamento = '".$_POST["medicamento"]."'";
		$resultado = $conexion->query($query); // se hace la busqueda en la base de datos
    	$ret = mysqli_fetch_array($resultado);
    	$arr = array('botiquin' => $ret["botiquin"], 'medicamento' => $ret["medicamento"], 'cantidad' => $ret["cantidad"]);
	    echo json_encode($arr);
    	mysqli_close($conexion);
    }else
    	echo "No ha proporcionado los parametros";
 ?>