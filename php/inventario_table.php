<?php
    include("config.php"); // se acre la conexion a la BD con la configuracion dada
    if(isset($_GET["nombre"]) && $_GET["nombre"] != "")
		$query = "SELECT `codigo`, `nombre`, `marca`, IF(STRCMP('', descripcion) = 0, 'N/a', descripcion) AS descripcion, `tipo`, CONCAT('$ ', `precioUnitario`) AS precioUnitario, IF(precioPublico = 0 , 'N/a', CONCAT('$ ', `precioPublico`)) AS precioPublico, `cantidadDisponible` FROM `tb_inventario` WHERE nombre LIKE '%".$_GET['nombre']."%' OR marca LIKE '%".$_GET["nombre"]."%'";
	else
		$query = "SELECT `codigo`, `nombre`, `marca`, IF(STRCMP('', descripcion) = 0, 'N/a', descripcion) AS descripcion, `tipo`, CONCAT('$ ', `precioUnitario`) AS precioUnitario, IF(precioPublico = 0 , 'N/a', CONCAT('$ ', `precioPublico`)) AS precioPublico, `cantidadDisponible` FROM `tb_inventario`";
    
    $resultado = $conexion->query($query); // se hace la busqueda en la base de datos
    while ($ret = mysqli_fetch_array($resultado)){ // se llena la tabla con los datos obtenidos de la consulta
        echo "<tr><td>".$ret['codigo']."</td><td>".$ret['nombre']."</td><td>".$ret['marca']."</td><td>".$ret['descripcion']."</td><td>".$ret['tipo']."</td><td>".$ret['precioUnitario']."</td><td>".$ret['precioPublico']."</td><td>".$ret['cantidadDisponible']."</td><td> <button type='button'  class='btn btn-primary' data-toggle='modal' data-target='#modal_update'id='".$ret['codigo']."'><span class='glyphicon glyphicon-pencil'></button></td><td> <button type='button' id='".$ret['codigo']."' class='btn btn-danger' data-toggle='modal' data-target='#modal_delete'><span class='glyphicon glyphicon-trash'></span></button></td></tr>
        ";
    }
    mysqli_close($conexion);
 ?>