<?php 
	include("config.php"); // se inicia conexion a BD con la configuracion dada
	$consulta = "SELECT * FROM tb_peticiones WHERE numero = '".$_POST['numero']."'";
	$resultado = $conexion->query($consulta); // se hace la busqueda en la base de datos
    $ret = mysqli_fetch_array($resultado);
    $today = getdate();
	$current_date = $today["year"]."-".$today["mon"]."-".$today["mday"];
    if($_POST["estado"] == "ELIMINADO"){
		$query1 = "DELETE FROM ".$ret["table"]."WHERE ".$ret["meta"]." = '".$ret['ID']."'";
		echo $query1;
		mysqli_query( $conexion, $query1 ) or die ( "Algo ha ido mal en la consulta a la base de datos");
		$udpate = "UPDATE `tb_peticiones` SET `fechaAprobada`= '".$current_date."', `estado`='ELIMINADO' WHERE numero = '".$_POST["numero"]."'";
		mysqli_query( $conexion, $udpate ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    }else{
    	if($_POST["estado"] == 'DENEGADO'){
    		$udpate = "UPDATE `tb_peticiones` SET `fechaAprobada`= '".$current_date."', `estado`='DENEGADO' WHERE numero = '".$_POST["numero"]."'";
    		echo $udpate;
			mysqli_query( $conexion, $udpate ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    	}	
    }
	mysqli_close( $conexion ); // se cierra conexion a BD
?>