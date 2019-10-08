<?php
    include("config.php"); // se acre la conexion a la BD con la configuracion dada
    if(isset($_POST["tipo"]) && $_POST["tipo"] != "" && $_POST["tipo"] != "ADMINISTRADOR")
		$query = "SELECT user, CONCAT(nombre, ' (', user, ')') AS empleado,`tipo` FROM `tb_empleados` WHERE tipo = '".$_POST["tipo"]."' ORDER BY empleado ASC";
	else
		$query = "SELECT user, CONCAT(nombre, ' (', user, ')', ' - ', tipo) AS empleado FROM `tb_empleados` WHERE tipo != 'ADMINISTRADOR' ORDER BY nombre ASC";
    
    $resultado = $conexion->query($query); // se hace la busqueda en la base de datos
    while ($ret = mysqli_fetch_array($resultado)){
            echo "
            <option value='".$ret['user']."'>".$ret['empleado']."</option>
            ";
    }
    mysqli_close($conexion);
 ?>