<?php
    include("config.php"); // se acre la conexion a la BD con la configuracion dada
    if(isset($_GET["nombre"]) && $_GET["nombre"] != "")
		$query = "SELECT * FROM tb_peticiones WHERE fechaSolicitud LIKE '%".$_GET['fecha']."%' ORDER BY fechaSolicitud ASC";
	else
		$query = "SELECT * FROM `tb_peticiones` ORDER BY fechaSolicitud ASC";
    
    $resultado = $conexion->query($query); // se hace la busqueda en la base de datos
    while ($ret = mysqli_fetch_array($resultado)){ // se llena la tabla con los datos obtenidos de la consulta
        echo "<tr><td>".$ret['fechaSolicitud']."</td><td>".$ret['empleado']."</td><td>".$ret['table']."</td><td>".$ret['ID']."</td><td>". $ret['descripcion']."</td><td>".(($ret['estado'] == "EN ESPERA") ? $ret['estado'] : $ret['estado']." EL : ".$ret["fechaAprobada"])."</td>".(($ret['estado'] == "EN ESPERA") ? "<td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modal_denegar' id='".$ret['numero']."'> Denegar </button><td>" : "").(($ret['estado'] == "EN ESPERA") ? "<td><button type='button' id='".$ret['numero']."' class='btn btn-danger' data-toggle='modal' data-target='#modal_delete'>Eliminar Registro</button></td>" : "" )."</tr>
        ";
    }
    mysqli_close($conexion);
 ?>