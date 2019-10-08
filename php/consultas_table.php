<?php
    include("config.php"); // se acre la conexion a la BD con la configuracion dada
    $ESP = "SET lc_time_names = 'es_MX' ";
    mysqli_query( $conexion, $ESP ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    if(isset($_GET["fecha"]) && $_GET["fecha"] != "")
		$query = "SELECT `IDConsulta`, CONCAT(nombre, IF(STRCMP(apodos, '') = 0, '', CONCAT('(', apodos, ')')), ' | ',municipio, ' - ', comunidad) AS cliente,`descripcion`, fechaRegistro, DATE_FORMAT(`fechaRegistro`,'%W %d/%M/%Y') AS fecha, IFNULL( DATE_FORMAT(`fechaProgramada`,'%W %d/%M/%Y'), 'Sin programar') AS fechaProgramada, IF(estado = 0, 'Pendiente', 'Realizada') AS estado, `prioridad`, `cuentaTotal`, `cuentaPagada`, `recepcionista`, IFNULL(veterinario, 'Sin asignar') AS veterinario FROM `tb_consultas` INNER JOIN tb_clientes ON tb_consultas.IDCliente = tb_clientes.IDCliente INNER JOIN tb_direcciones ON tb_clientes.direccion = tb_direcciones.IDDireccion WHERE fechaRegistro LIKE CONCAT('".$_GET["fecha"]."', '%')";
	else
		$query = "SELECT `IDConsulta`, CONCAT(nombre, IF(STRCMP(apodos, '') = 0, '', CONCAT('(', apodos, ')')), ' | ',municipio, ' - ', comunidad) AS cliente,`descripcion`, DATE_FORMAT(`fechaRegistro`,'%W %d/%M/%Y') AS fechaRegistro, IFNULL( DATE_FORMAT(`fechaProgramada`,'%W %d/%M/%Y'), 'Sin programar') AS fechaProgramada, IF(estado = 0, 'Pendiente', 'Realizada') AS estado, `prioridad`, `cuentaTotal`, `cuentaPagada`, `recepcionista`, IFNULL(veterinario, 'Sin asignar') AS veterinario FROM `tb_consultas` INNER JOIN tb_clientes ON tb_consultas.IDCliente = tb_clientes.IDCliente INNER JOIN tb_direcciones ON tb_clientes.direccion = tb_direcciones.IDDireccion;";
    $resultado = $conexion->query($query); // se hace la busqueda en la base de datos
    while ($ret = mysqli_fetch_array($resultado)){ // se llena la tabla con los datos obtenidos de la consulta
        echo "<tr><td>".$ret['IDConsulta']."</td><td>".$ret['fechaRegistro']."</td><td>".$ret["cliente"]."</td><td>".$ret["descripcion"]."</td><td>".$ret["prioridad"]."</td><td>".$ret['estado']."</td><td>$&nbsp;".$ret['cuentaTotal']."</td><td>$&nbsp;".$ret['cuentaPagada']."</td><td>".$ret['veterinario']."</td><td><a class='btn btn-success'href=tratamiento.php?IDConsulta=".$ret['IDConsulta']."><span class='glyphicon glyphicon-check'></span></a></td><td><button type='button'  class='btn btn-primary' data-toggle='modal' data-target='#modal_update'id='".$ret['IDConsulta']."'><span class='glyphicon glyphicon-pencil'></span></button></td><td> <button type='button' id='".$ret['IDConsulta']."' class='btn btn-danger' data-toggle='modal' data-target='#modal_delete'><span class='glyphicon glyphicon-trash'></span></button></td></tr>
        ";
    }
    mysqli_close($conexion);
 ?>