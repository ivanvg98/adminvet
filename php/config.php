<?php
	// Configuracion para conectar con MySQL y la base de datos
	$usuario = "root";
    $contrasena = "";
    $servidor = "localhost";
    $basededatos = "db_adminvet";
    $conexion = mysqli_connect( $servidor, $usuario, $contrasena ) or die ("ERROR CONEXION: No se ha podido conectar al servidor de Base de datos");
    $db = mysqli_select_db( $conexion, $basededatos ) or die ( "ERROR CONEXION: No se pudo conectar con la pase de datos" );
    mysqli_set_charset($conexion, 'utf8'); //Codificacion UTF-8
 ?>