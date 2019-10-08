<?php
    if(isset($_POST["codigo"]) && $_POST["codigo"] != ''){
    	include("config.php"); // se acre la conexion a la BD con la configuracion dada

		$query = "SELECT * FROM `tb_inventario` WHERE codigo = '".$_POST["codigo"]."'";
		$resultado = $conexion->query($query); // se hace la busqueda en la base de datos
    	$ret = mysqli_fetch_array($resultado);
    	$arr = array('codigo' => $ret["codigo"], 'nombre' => $ret["nombre"], 'marca' => $ret["marca"], 'descripcion' => $ret["descripcion"], 'tipo' => $ret["tipo"], 'precioUnitario' => $ret["precioUnitario"], 'precioPublico' => $ret["precioPublico"], 'cantidadDisponible' => $ret["cantidadDisponible"]);
    	    echo json_encode($arr);
    	mysqli_close($conexion);
    }else
    	echo "No ha proporcionado el parametro codigo";
 ?>