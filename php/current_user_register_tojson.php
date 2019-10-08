<?php
	/*Este script sirve para convertir un registro de mysql a un objeto JSON dado un ID*/
	session_start();
    if(isset($_SESSION["user"])){ //Verificamos que se haya pasado el ID como parametro POST
    	include("config.php"); //Cargamos la conexion con la base de datos
		$query = "SELECT user, nombre, tipo, telefono FROM `tb_empleados` WHERE user = '".$_SESSION["user"]."' LIMIT 1;";
	    $resultado = $conexion->query($query); // se hace la busqueda en la base de datos
	    $ret = mysqli_fetch_array($resultado);
	    $arr = array('user' => $ret["user"], 'nombre' => $ret["nombre"], 'telefono' => $ret["telefono"], 'tipo' => $ret["tipo"]);
	    echo json_encode($arr);
	    mysqli_close($conexion);
    }else //En caso de que no se haya proporcionado el parametro enviamos un mensaje de error
    	echo "ERROR";
 ?>