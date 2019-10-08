<?php
    include("config.php"); // se acre la conexion a la BD con la configuracion dada
	$query = "SELECT botiquin, `medicamento`, `cantidad`, CONCAT(marca, ' - ', nombre, ' ', descripcion) AS nombreMedicamento FROM `lista_medicamentos` INNER JOIN tb_inventario ON medicamento = codigo WHERE botiquin = '".$_GET["numero"]."'";

    $resultado = $conexion->query($query); // se hace la busqueda en la base de datos
    while ($ret = mysqli_fetch_array($resultado)){
        echo "<tr><td>".$ret['nombreMedicamento']."</td><td>".$ret['cantidad']."</td><td><button type='button' data-botiquin='".$ret['botiquin']."' data-medicamento='".$ret['medicamento']."' class='btn btn-danger' data-toggle='modal' data-target='#modal_delete_child'  data-nombre='".$ret['nombreMedicamento']."'><span class='glyphicon glyphicon-trash'></span> Agotado</button></td></tr>
        ";
    }
    mysqli_close($conexion);
 ?>