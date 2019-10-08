<?php 
	include('config.php'); // hace la conexion a BD con la configuracion dada
	session_start(); // se crea o reanuda la sesion actual

	$nickname = $_POST['user'];
	$password = $_POST['pwd'];

	$query = "SELECT * FROM tb_empleados WHERE user ='".$nickname."' AND password ='".$password."'";
 
	if($resultado = $conexion->query($query)){
		if($resultado->num_rows>0){
			$ret = mysqli_fetch_array($resultado); // convierte el resultado en un arreglo
			// se ponen variables de session
			$_SESSION["user"] = $nickname;
			$_SESSION["tipo"] = $ret['tipo'];
			$_SESSION["user_name"] = $ret['nombre'];
			if($_SESSION['tipo'] == "ADMINISTRADOR")
				header("Location: ../admin.php", true, 301);
			if($_SESSION['tipo'] == "VETERINARIO")
				header("Location: ../veterinario.php", true, 301);
			if($_SESSION['tipo'] == "RECEPCIONISTA")
				header("Location: ../recepcionista.php", true, 301);

		} else {
			echo'<script>$("#info").text = "Usuario o contraseñas incorrectas";</script>';
			header("Location: ../index.php", true, 301);
			exit();
		}
	}
?>