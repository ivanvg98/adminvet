<?php
    include("config.php"); // se acre la conexion a la BD con la configuracion dada
    $query = "SELECT * FROM `tb_clientes` ORDER BY nombre ASC";
    
    $resultado = $conexion->query($query); // se hace la busqueda en la base de datos
    while ($ret = mysqli_fetch_array($resultado)){ // se llena la tabla con los datos obtenidos de la consulta
        $cons = "SELECT * FROM tb_direcciones WHERE IDDireccion = ".$ret["direccion"];
        $res = $conexion->query($cons);
        $dir = mysqli_fetch_array($res);
        if($_POST['IDCliente'] == $ret['IDCliente'])
            if($ret['apodos'] != "")
                echo "
                <option value='".$ret['IDCliente']."' selected=''>".$ret['nombre']." (".$ret['apodos'].") - ".$dir["comunidad"]."</option>
                ";
            else
                echo "
                <option value='".$ret['IDCliente']."' selected=''>".$ret['nombre']." - ".$dir["comunidad"]."</option>
                ";
        else
            if($ret['apodos'] != "")
                echo "
                <option value='".$ret['IDCliente']."'>".$ret['nombre']." (".$ret['apodos'].") - ".$dir["comunidad"]."</option>
                ";
            else
                echo "
                <option value='".$ret['IDCliente']."'>".$ret['nombre']." - ".$dir["comunidad"]."</option>
                ";
    }
    mysqli_close($conexion);
 ?>