<?php
    include("config.php"); // se acre la conexion a la BD con la configuracion dada
    if(isset($_POST["nombre"]) && $_POST["nombre"] != "")
		$query = "SELECT * FROM tb_direcciones WHERE comunidad LIKE '%".$_POST["nombre"]."%' ORDER BY comunidad ASC";
	else
		$query = "SELECT * FROM `tb_direcciones`";
    
    $resultado = $conexion->query($query); // se hace la busqueda en la base de datos
    while ($ret = mysqli_fetch_array($resultado)){ // se llena la tabla con los datos obtenidos de la consulta
        echo "
            <option value='".$ret['IDDireccion']."'>".$ret['municipio']." - ".$ret["comunidad"]."</option>
        ";
    }
    mysqli_close($conexion);
 ?>