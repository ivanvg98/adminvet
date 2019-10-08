<?php session_start(); 
		/*Verificamos que exista una sesion; en caso de que no, se redireccionara 
		al usuario a la pagina de inicio de sesion*/
	if(!isset($_SESSION["tipo"]))
		header("Location: index.php", true, 301);
	else
		if($_SESSION["tipo"] != "ADMINISTRADOR")
			if($_SESSION["tipo"] == "VETERINARIO")
				header("Location: veterinario.php", true, 301);
			else
				header("Location: recepcionista.php", true, 301);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta author="Azpeita Hernández Vladimir">
    <meta charset="UTF-8">
    <title>Empleados</title>

    <!-- Dependencias bootstrap  y script externos -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/sorttable.js"></script>    
    
    <!-- Scripts de la aplicacion -->
    <script type="text/javascript" src="js/general.js"></script>
    <script type="text/javascript" src="js/empleados.js"></script>

    <!-- Hojas de estito -->
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
	<!-- Barra de navegacion superior -->
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<!-- extremo izquierdo de la barra -->
            <div class="navbar-header">
				<a class="navbar-brand" href=""><span class="glyphicon glyphicon-home"></span> Inicio </a>
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
		<div class="container-fluid row form-inline">
			<div class="container col-lg-6 text-left">
				<b class="title-table">Tabla de empleados</b> <button type='button' class='btn btn-success' data-toggle='modal' data-target='#modal_insert' id='btn-new'> Agregar empleado</button>
			</div>
			<div class="container col-lg-6 text-right">
				<label for="search"> Buscar empleado: </label>
				<input type="search" class="form-control" id="search" placeholder="Buscar" > 
			</div>
		</div>
		<div class="container-fluid alert-zone"> 
			
		</div>
        <hr> 
        
        <table class="table table-striped sortable">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Nombre completo</th>
                    <th>Telefono</th>
                    <th>Tipo de usuario</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="display_table"> </tbody>
        </table>      
    </div>

   <!-- Modal para agregar -->
	<div class='modal' id='modal_insert'>	
	  <div class='modal-dialog'>
	    <div class='modal-content'>
			<form id="frm_insert" autocomplete="off">
			<!-- Modal Header -->
			<div class='modal-header'>
				<h3 class='modal-title'>Agregar un nuevo empleado</h3>
				<button type='button' class='close' data-dismiss='modal'>&times;</button>
			</div>
			
			<!-- Modal body -->
			<div class='modal-body'>
				<div class="form-group">
					<label for="user">Nickname(<span id="disponible" style="color:#45932CFF;">Disponible</span>)</label>
					<input id="user" type="text" class="form-control" name="user" required="" pattern="[a-zA-ZñÑ]{4,50}" placeholder="Nombre de usuario">
				</div>
				<div class="form-group row">
					<div class="form-group col-md-6">
						<label for="Nombre">Nombre completo</label>
						<input type="text" class="form-control" name="nombre" required="" pattern="[a-z A-ZñÑáéíóúÁÉÍÓÚüÜ.]{5,100}" placeholder="Nombre y apellidos" autocomplete="new-password">
					</div>
					<div class="form-group col-md-6">
						<label for="telefono">Telefono</label>
						<input type="tel" class="form-control" name="telefono" placeholder="Teléfono o celular" pattern="[0-9]{10}" autocomplete="new-password">
					</div>
				</div>
				<div class="form-group">
					<label for="tipo">Tipo de usuario</label>
					<select class="form-control" name="tipo">
						<option value="VETERINARIO">VETERINARIO</option>
						<option value="RECEPCIONISTA">RECEPCIONISTA</option>
					</select>
				</div>
				<div class="form-group row">
					<div class="form-group col-md-6">
						<label for="password">Contraseña</label>
						<input type="password" class="form-control" name="password" required="" placeholder="Contraseña" autocomplete="new-password">
					</div>
					<div class="form-group col-md-6">
						<label for="password2">Escriba nuevamente la contraseña</label>
						<input type="password" class="form-control" name="password2" required="" placeholder="Escriba de nuevo la contraseña" autocomplete="new-password">
					</div>
				</div>
				
			</div> 

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel_insert">Cancelar</button>
				<input type="submit" class="btn btn-primary submit" value="Guardar">
			</div>
		</form>
	    </div>
	  </div>
	</div>

	<!-- Modal para actualizar-->
	<div class='modal' id='modal_update'>	
	  <div class='modal-dialog'>
	    <div class='modal-content'>
			<form id="frm_update" autocomplete="off">
			<!-- Modal Header -->
			<div class='modal-header'>
				<h3 class='modal-title'>Actualizar información del empleado</h3>
				<button type='button' class='close' data-dismiss='modal'>&times;</button>
			</div>
			<!-- Modal body -->
			<div class='modal-body'>
				<div class="alert alert-info">
						<strong>Información:</strong> No puedes cambiar el nickname.
					</div>
				<div class="form-group">
					<label for="user">Nickname</label>
					<input id="user" type="text" class="form-control" name="user" required="" pattern="[a-zA-ZñÑ]{4,50}" placeholder="Nombre de usuario" readonly="">

				</div>
				<div class="form-group row">
					<div class="form-group col-md-6">
						<label for="Nombre">Nombre completo</label>
						<input type="text" class="form-control" name="nombre" required="" pattern="[a-z A-ZñÑáéíóúÁÉÍÓÚüÜ.]{5,100}" placeholder="Nombre y apellidos">
					</div>
					<div class="form-group col-md-6">
						<label for="telefono">Telefono</label>
						<input type="text" class="form-control" name="telefono" placeholder="Teléfono o celular" pattern="[0-9]{10}">
					</div>
				</div>
				<div class="form-group">
					<label for="tipo">Tipo de usuario</label>
					<select class="form-control" name="tipo">
						<option value="VETERINARIO">VETERINARIO</option>
						<option value="RECEPCIONISTA">RECEPCIONISTA</option>
					</select>
				</div>

				<div class="form-group">
					<label for="opc">¿Quieres asignar una nueva contraseña al usuario?</label>
					<select name="opc" class="form-control">
						<option value="NO" selected="">NO</option>
						<option value="SI">SÍ</option>
					</select>
				</div>

				<div class="form-group row" id="group_password">
					<div class="form-group col-md-6">
						<label for="password">Escriba la nueva contraseña</label>
						<input type="password" class="form-control" name="password" placeholder="Contraseña">
					</div>
					<div class="form-group col-md-6">
						<label for="password2">Escriba nuevamente la contraseña</label>
						<input type="password" class="form-control" name="password2" placeholder="Escriba de nuevo la contraseña">
					</div>
				</div>
				
			</div> 

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<input type="submit" class="btn btn-primary submit" value="Guardar">
			</div>
		</form>
	    </div>
	  </div>
	</div>

	<!-- Modal para eliminar-->
	<div class='modal' id='modal_delete' style='margin-top:150px;'>	
	  <div class='modal-dialog'>
	    <div class='modal-content'>

			<!-- Modal Header -->
			<div class='modal-header'>
				<h3 class='modal-title'>Eliminar articulo</h3>
				<!--<button type='button' class='close' data-dismiss='modal'>&times;</button>-->
			</div>

			<!-- Modal body -->
			<div class='modal-body'>
				<h5>¿Desea borrar a <b><span id="nombre"></span></b> con el nombre de usuario <b><span id="user"></span></b>?</h5>
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