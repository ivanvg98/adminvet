<?php
	/*Este script sirve para convertir un registro de mysql a un objeto JSON dado un ID*/
    if(isset($_POST["IDCliente"])){ //Verificamos que se haya pasado el ID como parametro POST
    	include("config.php"); //Cargamos la conexion con la base de datos
		
		$query = "SELECT `IDCliente`, `nombre`, `apodos`, `direccion`, `referencias`, `telefono`, CONCAT(municipio,'-',comunidad) AS direccionCompleta, CONCAT(nombre, '(', IFNULL(apodos, 'Sin apdos'), ')') AS nombreCompleto FROM `tb_clientes` INNER JOIN tb_direcciones ON direccion = IDDireccion WHERE IDCliente = ".$_POST["IDCliente"]." LIMIT 1;";
		$resultado = $conexion->query($query);
	    $ret = mysqli_fetch_array($resultado);
	    $arr = array('IDCliente' => $ret["IDCliente"], 'nombre' => $ret["nombre"], 'apodos' => $ret["apodos"], 'telefono' => $ret["telefono"], 'direccion' => $ret["direccion"], 'referencias' => $ret["referencias"], 'nombreCompleto' => $ret["nombreCompleto"], 'direccionCompleta' => $ret["direccionCompleta"]);
	    echo json_encode($arr);
	    mysqli_close($conexion);
    }else //En caso de que no se haya proporcionado el parametro enviamos un mensaje de error
    	echo "ERROR: No ha proporcionado el parametro IDCliente";
 ?>