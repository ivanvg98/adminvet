<?php
	/*Este script sirve para convertir un registro de mysql a un objeto JSON dado un ID*/
    if(isset($_POST["numero"])){ //Verificamos que se haya pasado el ID como parametro POST
    	include("config.php"); //Cargamos la conexion con la base de datos
		
		$query = "SELECT `numero`, `descripcion`, `veterinario` FROM `tb_botiquin` WHERE numero = '".$_POST["numero"]."' LIMIT 1;";
		$resultado = $conexion->query($query);
	    $ret = mysqli_fetch_array($resultado);
	    $arr = array('numero' => $ret["numero"], 'descripcion' => $ret["descripcion"], 'veterinario' => $ret["veterinario"]);
	    echo json_encode($arr);
	    mysqli_close($conexion);
    }else //En caso de que no se haya proporcionado el parametro enviamos un mensaje de error
    	echo "ERROR: No ha proporcionado el parametro IDCliente";
 ?>