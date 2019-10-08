<?php
 	//Script para eliminar un registro de una tabla. Solo podran eliminar los usuarios administradores.
	session_start(); // Iniciamos sesion para verificar el tipo de usuario.	
	if($_SESSION["tipo"] == "ADMINISTRADOR"){
		include("config.php"); //Se carga la conexion con la base de datos
		$query = "DELETE FROM `tb_clientes` WHERE `IDCliente` = '".$_POST['IDCliente']."'";
		mysqli_query( $conexion, $query ) or die ( "Algo ha ido mal en la consulta a la base de datos");
		mysqli_close( $conexion ); // se cierra conexion a BD
	}else
		echo "Necesitas ser administrador para eliminar registros";
?>