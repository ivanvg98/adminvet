<?php
    include("config.php"); // se acre la conexion a la BD con la configuracion dada
    if(isset($_GET["nombre"]) && $_GET["nombre"] != "")
		$query = "SELECT * FROM tb_clientes WHERE nombre LIKE '%".$_GET['nombre']."%' OR apodos LIKE '%".$_GET["nombre"]."%' ORDER BY IDCliente DESC";
	else
		$query = "SELECT * FROM `tb_clientes` ORDER BY IDCliente DESC";
    
    $resultado = $conexion->query($query); // se hace la busqueda en la base de datos
    while ($ret = mysqli_fetch_array($resultado)){ // se llena la tabla con los datos obtenidos de la consulta
        $cons = "SELECT * FROM tb_direcciones WHERE IDDireccion = ".$ret["direccion"];
        $res = $conexion->query($cons);
        $dir = mysqli_fetch_array($res);
        $direccion = $dir["municipio"]." - ".$dir["comunidad"];
        echo "<tr".((isset($_GET["IDCliente"])) ? (($_GET["IDCliente"] == $ret["IDCliente"]) ? "class='table-active'" : "" ): "")."><td>".$ret['IDCliente']."</td><td>".$ret['nombre'].( ($ret['apodos'] == "") ? "" : "<em>(".$ret['apodos'].")</em>" )."</td><td>".$direccion."</td><td>".$ret['referencias']."</td><td>".$ret['telefono']."</td><td> <button type='button'  class='btn btn-primary' data-toggle='modal' data-target='#modal_update'id='".$ret['IDCliente']."'><span class='glyphicon glyphicon-pencil'></span> Editar</button></td><td> <button type='button' id='".$ret['IDCliente']."' class='btn btn-danger' data-toggle='modal' data-target='#modal_delete'><span class='glyphicon glyphicon-trash'></span> Eliminar</button></td></tr>
        ";
    }
    mysqli_close($conexion);
 ?>