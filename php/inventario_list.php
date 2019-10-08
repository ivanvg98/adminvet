<?php
    include("config.php"); // se acre la conexion a la BD con la configuracion dada
    if(isset($_POST["nombre"]) && $_POST["nombre"] != "")
		$query = "SELECT `codigo`, CONCAT(marca, ' - ', nombre, ' ', descripcion) AS nombreMedicamento, nombre, marca FROM `tb_inventario` WHERE nombre LIKE '%".$_POST["nombre"]."%' OR marca LIKE '%".$_POST["nombre"]."%' ORDER BY nombreMedicamento DESC";
	else
		$query = "SELECT `codigo`, CONCAT(marca, ' - ', nombre, ' ', descripcion) AS nombreMedicamento FROM `tb_inventario` ORDER BY nombreMedicamento DESC";
    
    $resultado = $conexion->query($query); // se hace la busqueda en la base de datos
    while ($ret = mysqli_fetch_array($resultado)){ // se llena la tabla con los datos o
        echo "
            <option value='".$ret['codigo']."'>".$ret["nombreMedicamento"]."</option>
            ";
    }
    mysqli_close($conexion);
 ?>