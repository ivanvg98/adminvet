<?php
    include("config.php"); // se acre la conexion a la BD con la configuracion dada
	$query = "SELECT numero, descripcion, IFNULL(veterinario, 'Sin asignar')AS veterinario FROM `tb_botiquin` ORDER BY numero ASC";
    $resultado = $conexion->query($query); // se hace la busqueda en la base de datos
    while ($ret = mysqli_fetch_array($resultado)){
        echo "<tr><td>".$ret['numero']."</td><td>".$ret['descripcion']."</td><td>".$ret["veterinario"]."</td><td><button type='button'  class='btn btn-success' data-toggle='modal' data-target='#modal_list' id='".$ret['numero']."'  data-id='".$ret['numero']."'>Ver contenido</button></td><td><button type='button'  class='btn btn-primary' data-toggle='modal' data-target='#modal_update'id='".$ret['numero']."'><span class='glyphicon glyphicon-pencil'></span> Editar</button></td><td> <button type='button' id='".$ret['numero']."' class='btn btn-danger' data-toggle='modal' data-target='#modal_delete'><span class='glyphicon glyphicon-trash'></span> Eliminar</button></td></tr>
        ";
    }
    mysqli_close($conexion);
 ?>