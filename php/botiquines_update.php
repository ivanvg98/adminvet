<?php 
	include("config.php"); // se inicia conexion a BD cin la configuracion dada
	if($_POST["veterinario"] != "null")
		$query = "UPDATE `tb_botiquin` SET `descripcion`='".$_POST["descripcion"]."',`veterinario`='".$_POST["veterinario"]."' WHERE `numero` = '".$_POST['numero']."'";
	else
		$query = "UPDATE `tb_botiquin` SET `descripcion`='".$_POST["descripcion"]."',`veterinario`= NULL WHERE `numero` = '".$_POST['numero']."'";

	mysqli_query( $conexion, $query ) or die ("ERROR");
	mysqli_close( $conexion ); // se cierra conexion a BD
?>