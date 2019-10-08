<?php 
    /*Verificamos que exista una sesion; en caso de que no, se redireccionara 
        al usuario a la pagina de inicio de sesion*/
    session_start(); 
    if(!isset($_SESSION["user"])) 
        header("Location: index.php", true, 301); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta author="Azpeita Hernández Vladimir">
    <meta charset="UTF-8">
    <title>Peticiones</title>

    <!-- Dependencias bootstrap  y script externos -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/sorttable.js"></script>    
    
    <!-- Scripts de la aplicacion -->
    <script type="text/javascript" src="js/general.js"></script>
    <script type="text/javascript" src="js/peticiones.js"></script>

    <!-- Hojas de estito -->
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <!-- Barra de navegacion superior -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <!-- extremo izquierdo de la barra -->
            <div class="navbar-header">
                <a class="navbar-brand active" href=""><span class="glyphicon glyphicon-home"></span> Inicio </a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="consultas.php">Consultas</a></li>
                <li><a href="clientes.php">Clientes</a></li>
                <li><a href="inventario.php">Inventario</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <!-- extremo derecho de la barra -->
            <li class="dropdown"><a  class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="img/usuario.png" class="img-circle" alt="Cinque Terre"></a>
                <ul class="dropdown-menu">
                    <li><a href="user_opciones.php">Configuración</a></li>
                    <li><a href="php/logout.php">Cerrar Sesión</a></li>
                </ul>
            </li>
        </ul>
        </div>
    </nav> 

	<div class="container-fluid">
		<h3>Peticiones para borrar registros</h3>
        <hr> 
        <div class="form-inline">
	        Buscar: <input type="date" class="form-control" id="search">
        </div>
        <table class="table table-striped sortable">
            <thead>
                <tr>
                    <th>Fecha de solicitud</th>
                    <th>Empleado</th>
                    <th>Tabla</th>
                    <th>Registro</th>
                    <th>Descripción</th>
                    <th>Estado</th>                                     
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="display_table">

            </tbody>
        </table>      
	</div>

    <div class='modal' id='modal_denegar' style='margin-top:150px;'> 
      <div class='modal-dialog'>
        <div class='modal-content'>

            <!-- Modal Header -->
            <div class='modal-header'>
                <h3 class='modal-title'>Número de petición <span class="numero"></span></h3>
                <!--<button type='button' class='close' data-dismiss='modal'>&times;</button>-->
            </div>

            <!-- Modal body -->
            <div class='modal-body'>
                <h5>¿Desea denegar las solicitud para borrar el registro con clave <b><span class="ID"></span></b> de la tabla <b><span class="table"></span></b>?</h5>
            </div> 

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel_denegar">Cancelar</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" id="denegar_btn">Denegar</button>
            </div>
        </div>
    </div>
    </div>
    <div class='modal' id='modal_delete' style='margin-top:150px;'> 
      <div class='modal-dialog'>
        <div class='modal-content'>

            <!-- Modal Header -->
            <div class='modal-header'>
                <h3 class='modal-title'>Número de petición <span class="numero"></span></h3>
                <!--<button type='button' class='close' data-dismiss='modal'>&times;</button>-->
            </div>

            <!-- Modal body -->
            <div class='modal-body'>
                <h5>¿Desea borrar el registro con clave <b><span class="ID"></span></b> de la tabla <b><span class="table"></span></b>?</h5>
            </div> 

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel_delete">Cancelar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="borrar_btn">Borrar</button>
            </div>
        </div>
    </div>
    </div>
</body>
</html>