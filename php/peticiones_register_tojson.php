<?php
    include("config.php"); // se acre la conexion a la BD con la configuracion dada
    if(isset($_POST["numero"]))
		$query = "SELECT * FROM `tb_peticiones` WHERE numero = '".$_POST["numero"]."'";
    
    $resultado = $conexion->query($query); // se hace la busqueda en la base de datos
    $ret = mysqli_fetch_array($resultado);
    $arr = array('numero' => $ret["numero"], 'empleado' => $ret["empleado"], 'table' => $ret["table"], 'meta' => $ret["meta"], 'ID' => $ret["ID"], 'fechaSolicitud' => $ret["fechaSolicitud"], 'fechaAprobada' => $ret["fechaAprobada"], 'descripcion' => $ret["descripcion"], 'estado' => $ret["estado"]);
    echo json_encode($arr);
    mysqli_close($conexion);
 ?>