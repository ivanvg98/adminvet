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
    <title>Botiquines</title>

    <!-- Dependencias bootstrap  y script externos -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/sorttable.js"></script>    
    
    <!-- Scripts de la aplicacion -->
    <script type="text/javascript" src="js/general.js"></script>
    <script type="text/javascript" src="js/botiquines.js"></script>

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
				<b class="title-table">Tabla de botiquines</b> <button type='button' class='btn btn-success' data-toggle='modal' data-target='#modal_insert' id='btn-new'> Agregar botiquin</button>
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
				<h3 class='modal-title'>Agregar un nuevo botiquin</h3>
				<button type='button' class='close' data-dismiss='modal'>&times;</button>
			</div>

			<!-- Modal body -->
			<div class='modal-body'>
				<div class="form-group">
					<label for="descripcion">Descripción del botiquin</label>
					<textarea name="descripcion" rows="2" class="form-control" required="" placeholder="Escriba una breve descripcion para poder identificar el botiquin con más facilidad"></textarea>
				</div>
				<div class="form-group">
					<label for="veterinario">Asignar a veterinario</label>
					<select name="veterinario" class="form-control" required=""></select>
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
				<h3 class='modal-title'>Actualizar información del botiquin</h3>
				<button type='button' class='close' data-dismiss='modal'>&times;</button>
			</div>

			<!-- Modal body -->
			<div class='modal-body'>
				<div class="form-group">
					<label for="numero">Descripción del botiquin</label>
					<input type="text" name="numero" required="" readonly="" class="form-control"> 
				</div>
				<div class="form-group">
					<label for="descripcion">Descripción del botiquin</label>
					<textarea name="descripcion" rows="2" class="form-control" required="" placeholder="Escriba una breve descripcion para poder identificar el botiquin con más facilidad"></textarea>
				</div>
				<div class="form-group">
					<label for="veterinario">Asignar a veterinario</label>
					<select name="veterinario" class="form-control" required=""></select>
				</div>				
			</div> 

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel_insert">Cancelar</button>
				<input type="submit" class="btn btn-primary" value="Guardar cambios">
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
						<label for="numero">Número de botiquin:</label>
						<input type="text" class="form-control info" readonly="" name="numero">
					</div>
					<div class="form-group col-md-8">
						<label for="descripcion">Descripción:</label>
						<input type="text" name="descripcion" class="form-control info" readonly="">
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

	<!-- Modal del contenidp del botiquin -->
	<div class='modal fade' id='modal_list'>	
	  <div class='modal-dialog modal-lg'>
	    <div class='modal-content'>
			<!-- Modal Header -->
			<div class='modal-header'>
				<h3 class='modal-title'>Contenido del botiquin <span id="numero"></span> <button id='btn_add' class="btn btn-success" data-toggle='modal' data-target='#modal_add'>Agregar medicamento</button></h3>
				<div class="alert-zone-child"></div>
			</div>
			<!-- Modal body -->
			<div class='modal-body'>	
				<table class="table table-bordered">
					<thead style="background: #2F343F; color: #fff;">
						<tr>
							<th>Medicamento</th>
							<th>Cantidad</th>
							<th></th>
						</tr>
					</thead>
					<tbody id="display_table_list"></tbody>
				</table>
			</div> 
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
	    </div>
	  </div>
	</div>


	<!-- Modal para añadir medicamentos al botiquin -->
	<div class='modal' id='modal_add'>	
	  <div class='modal-dialog'>
	    <div class='modal-content'>
	    	<form id="frm_add" autocomplete="off">
			<!-- Modal Header -->
			<div class='modal-header'>
				<h3 class='modal-title'>Agregar medicamento</h3>
			</div>
			<!-- Modal body -->
			<div class='modal-body'>
				<div class="form-group">
					<label for="botiquin">Botiquin</label>
					<input type="text" name="botiquin" readonly="" required="" class="form-control">
				</div>
				<div class="form-group row">
					<div class="form-group col-md-8">
						<label for="medicamento">Medicamento</label>
						<select class="form-control" name="medicamento" required=""></select>
					</div>
					<div class="form-group col-md-4">
						<label for="search">Buscar</label>
						<input type="search" class="form-control" name="search">
					</div>
				</div>
				<div class="form-group">
					<label for="cantidad">Cantidad</label>
					<select class="form-control"  name="cantidad" required=""></select>
				</div>
			</div> 
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<input type="submit" class="btn btn-primary" value="Agregar">
			</div>
			</form>
	    </div>
	  </div>
	</div>

	<!-- Modal medicamento agotado -->
	<div class='modal' id='modal_delete_child'>	
	  <div class='modal-dialog'>
	    <div class='modal-content'>
	    	<form id="frm_delete_child" autocomplete="off">
			<div class='modal-header'>
				<h3>Medicamento agotado.</h3>
			</div>

			<!-- Modal body -->
			<div class='modal-body'>
				<div class="form-group row">
					<div class="form-group col-md-4">
						<label for="botiquin">Número de botiquin:</label>
						<input type="text" class="form-control info" readonly="" name="botiquin">
					</div>
					<div class="form-group col-md-8">
						<label for="medicamento">Medicamento:</label>
						<select name="medicamento" class="form-control" required="">
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="cantidad">Cantidad agotada</label>
					<select name="cantidad" class="form-control" required=""></select>
				</div>
				<div class="alert alert-danger">
					<b><span class="glyphicon glyphicon-exclamation-sign"></span> Precaución:</b> Tenga cuidado al momento de agotar algun producto, ya que este se considerara fuera de invetario e inexistente.
				</div>
			</div> 

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<input type="submit" class="btn btn-danger" value="Agotado">
			</div>
			</form>
	    </div>
	  </div>
	</div>
</body>
</html>