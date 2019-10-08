<?php
    include("config.php"); // se acre la conexion a la BD con la configuracion dada
    if(isset($_POST["IDConsulta"]))
		$query = "SELECT `IDConsulta`, `IDCliente`, `descripcion`, `fechaRegistro`, DATE(`fechaProgramada`) AS fecha, DATE_FORMAT(`fechaProgramada`,'%H:%i') AS hora, `estado`, `cuentaTotal`, `cuentaPagada`, `prioridad`, `recepcionista` FROM `tb_consultas` WHERE IDConsulta = '".$_POST['IDConsulta']."';";
    
    $resultado = $conexion->query($query); // se hace la busqueda en la base de datos
    $ret = mysqli_fetch_array($resultado);
    $consulta = "SELECT * FROM tb_clientes WHERE IDCliente = '".$ret["IDCliente"]."'";
    $res = $conexion->query($consulta);
    $cliente = mysqli_fetch_array($res);
    $cons = "SELECT * FROM tb_direcciones WHERE IDDireccion = ".$cliente["direccion"];

    $res = $conexion->query($cons);
    $dir = mysqli_fetch_array($res);
    $arr = array('IDConsulta' => $_POST["IDConsulta"], 'IDCliente' => $ret["IDCliente"], 'descripcion' => $ret["descripcion"], 'fechaRegistro' => $ret["fechaRegistro"], 'fecha' => $ret["fecha"], 'hora' => $ret["hora"], 'estado' => $ret["estado"], 'cuentaTotal' => $ret["cuentaTotal"], 'nombreCliente' => $cliente["nombre"].(($cliente["apodos"] == "") ? "" : "(".$cliente["apodos"].")")." - ".$dir["comunidad"], 'cuentaPagada' => $ret["cuentaPagada"], 'prioridad' => $ret["prioridad"], 'recepcionista' => $ret["recepcionista"]);
    echo json_encode($arr);
    mysqli_close($conexion);
 ?>