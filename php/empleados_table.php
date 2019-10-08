<?php
    include("config.php"); // se acre la conexion a la BD con la configuracion dada
    if(isset($_GET["nombre"]) && $_GET["nombre"] != "")
		$query = "SELECT user, nombre, tipo, telefono FROM tb_empleados WHERE nombre LIKE '%".$_GET['nombre']."%' OR user LIKE '%".$_GET["nombre"]."%' AND tipo != 'ADMINISTRADOR'";
	else
		$query = "SELECT user, nombre, tipo, telefono FROM `tb_empleados` WHERE tipo != 'ADMINISTRADOR'";
    
    $resultado = $conexion->query($query); // se hace la busqueda en la base de datos
    while ($ret = mysqli_fetch_array($resultado)){ // se llena la tabla con los datos obtenidos de la consulta
        echo "<tr><td>".$ret['user']."</td><td>".$ret['nombre']."</td><td>".$ret['telefono']."</td><td>".$ret['tipo']."</td><td> <button type='button'  class='btn btn-primary' data-toggle='modal' data-target='#modal_update'id='".$ret['user']."'><span class='glyphicon glyphicon-pencil'></span> Actualizar</button></td><td> <button type='button' id='".$ret['user']."' class='btn btn-danger' data-toggle='modal' data-target='#modal_delete'><span class='glyphicon glyphicon-trash'></span> Eliminar</button></td></tr>
        ";
    }
    mysqli_close($conexion);
 ?>