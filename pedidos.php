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
    <title>Pedidos</title>

    <!-- Dependencias bootstrap  y script externos -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/sorttable.js"></script>    
    
    <!-- Scripts de la aplicacion -->
    <script type="text/javascript" src="js/general.js"></script>
    <script type="text/javascript" src="js/pedidos.js"></script>

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

	<!-- Contenedor principal -->
	<div class="container-fluid">
		<div class="container-fluid row form-inline">
			<div class="container col-lg-6 text-left">
				<b class="title-table">Tabla de procutos para pedido</b> <button type='button' class='btn btn-success' data-toggle='modal' data-target='#modal_insert' id='btn-new'> Hacer pedido</button>
			</div>
			<div class="container col-lg-6 text-right">
					<!-- <label for="search"> Buscar cliente: </label>
					<input type="search" class="form-control" id="search" placeholder="Buscar" > --> 
			</div>
		</div>
		<div class="alert-zone"></div>
 	    <hr> 
        
        <table class="table table-striped sortable">
            <thead>
                <tr>
                    <th>Número de botiquin</th>
                    <th>Descripción</th>
                    <th>Veterinario asignado</th>
                    <th></th>                  
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
				<h3 class='modal-title'>Agregar un nuevo cliente</h3>
				<button type='button' class='close' data-dismiss='modal'>&times;</button>
			</div>

			<!-- Modal body -->
			<div class='modal-body'>				
				<div class="form-group row">
					<div class="form-group col-md-7">
						<label for="Nombre">Nombre</label>
						<input type="text" class="form-control" name="nombre" required="" pattern="[a-z A-ZñÑáéíúóÁÉÍÓÚñÑ.üÜ]{4,100}" placeholder="Nombre y apellido(s)">
					</div>
					<div class="form-group col-md-5">
						<label for="nombresClave">Apodo(s)</label>
						<input type="text" class="form-control" name="apodos" pattern="[a-z A-ZñÑáéíúóÁÉÍÓÚñÑ.üÜ]{1,50}" placeholder="Apodo(s) (opcional)">
					</div>
				</div>

				<div class="form-group row">
					<div class="form-group col-md-7">
						<label for="municipio">Seleccionar dirección</label>
						<select class="form-control list_dir" name="direccion" required="">
							<option value="" selected=""> -- Seleccionar -- </option>
						</select>
					</div>
					<div class="form-group col-md-5">
						<label for="search">Buscar</label>
						<input type="search" name="search" class="form-control search_dir" placeholder="Buscar">
					</div>
				</div>

				<div class="form-group">
					<label for="referencias">Referencias de la vivienda</label>
					<textarea class="form-control" name="referencias" rows="2" pattern="[a-z A-ZñÑáéíúóÁÉÍÓÚñÑ.üÜ]{4,100}" placeholder="Escriba algunas referencias para hallar el domicilio del cliente"></textarea>
				</div>

				<div class="form-group">
					<label for="telefono">Teléfono</label>
					<input type="text" class="form-control" name="telefono" pattern="[0-9]{10}" placeholder="10 digitos">
				</div>
				
			</div> 

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel_insert">Cancelar</button>
				<input type="submit" class="btn btn-primary" value="Guardar">
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
				<h3 class='modal-title'>Actualizar información cliente</h3>
				<button type='button' class='close' data-dismiss='modal'>&times;</button>
			</div>

			<!-- Modal body -->
			<div class='modal-body'>
				<div class="form-group">
					<label for="IDCliente">Clave única del cliente</label>
					<input type="text" class="form-control" name="IDCliente" readonly="">
				</div>
				<div class="form-group row">
					<div class="form-group col-md-7">
						<label for="Nombre">Nombre</label>
						<input type="text" class="form-control" name="nombre" required="" pattern="[a-z A-ZñÑáéíúóÁÉÍÓÚñÑ.üÜ]{3,100}" placeholder="Nombre y apellido(s)">
					</div>
					<div class="form-group col-md-5">
						<label for="nombresClave">Apodo(s)</label>
						<input type="text" class="form-control" name="apodos" pattern="[a-z A-ZñÑáéíúóÁÉÍÓÚñÑ.üÜ]{1,50}" placeholder="Apodo(s) (opcional)">
					</div>
				</div>

				<div class="form-group row">
					<div class="form-group col-md-7">
						<label for="municipio">Seleccionar dirección</label>
						<select class="form-control list_dir" name="direccion" required="">
							<option value="" selected=""> -- Seleccionar -- </option>
						</select>
					</div>
					<div class="form-group col-md-5">
						<label for="search">Buscar</label>
						<input type="search" name="search" class="form-control search_dir">
					</div>
				</div>

				<div class="form-group">
					<label for="referencias">Referencias de la vivienda</label>
					<textarea class="form-control" name="referencias" rows="2" pattern="[a-z A-ZñÑáéíúóÁÉÍÓÚñÑ.üÜ]{4,100}" placeholder="Escriba algunas referencias para hallar el domicilio del cliente"></textarea>
				</div>

				<div class="form-group">
					<label for="telefono">Teléfono</label>
					<input type="text" class="form-control" name="telefono" pattern="[0-9]{10}" placeholder="10 digitos">
				</div>
		
			</div> 

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<input type="submit" class="btn btn-info" value="Guardar cambios">
			</div>
			</form>
	    </div>
	  </div>
	</div>

	<!-- Modal para eliminar-->
	<div class='modal fade' id='modal_delete'>	
	  <div class='modal-dialog modal-lg'>
	    <div class='modal-content'>
			<form id="frm_delete" autocomplete="off">
			<!-- Modal Header -->
			<div class='modal-header'>
				<h3>¿Realmente deseea borrar el registro con la siguiete información?</h3>
			</div>

			<!-- Modal body -->
			<div class='modal-body'>
				<div class="form-group row">
					<div class="form-group col-md-4">
						<label for="IDCliente">Cláve única del cliente:</label>
						<input type="text" class="form-control info" readonly="" name="IDCliente">
					</div>
					<div class="form-group col-md-8">
						<label for="nombre">Nombre del cliente:</label>
						<input type="text" name="nombre" class="form-control info" readonly="">
					</div>
				</div>
				<div class="alert alert-danger">
					<b><span class="glyphicon glyphicon-exclamation-sign"></span> Precaución:</b> Tenga cuidado al momento de eliminar registros. Prodría eliminar información relevante de los clientes.
				</div>
			</div> 

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<input type="submit" class="btn btn-danger" value="Borrar">
			</div>
			</form>
	    </div> 
	  </div>
	</div>
</body>
</html>