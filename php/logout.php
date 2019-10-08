<?php
session_start(); // se crea o reanuda la sesion actual
session_unset();
session_destroy(); // se destruye la session
header("Location: ../index.php", true, 301);
?>