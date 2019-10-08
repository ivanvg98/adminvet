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
    <title>Consultas</title>

    <!-- Dependencias bootstrap  y script externos -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/sorttable.js"></script>    
    
    <!-- Scripts de la aplicacion -->
    <script type="text/javascript" src="js/general.js"></script>
    <script type="text/javascript" src="js/consultas.js"></script>

    <!-- Hojas de estilo de la aplicacion -->
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
				<li><a href="consultas.php" class="active">Consultas</a></li>
				<li><a href="clientes.php">Clientes</a></li>
				<li><a href="inventario.php">Inventario</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<!-- extremo derecho de la barra -->
			<li class="dropdown"><a  class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="img/usuario.png" class="img-circle" alt="Cinque Terre" ></a>
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
				<b class="title-table">Tabla de consultas</b> <button type='button' class='btn btn-success' data-toggle='modal' data-target='#modal_insert' id='btn-new'> Agregar consulta</button>
			</div>
			<div class="container col-lg-6 text-right">
				<label for="search"> Buscar por fecha: </label>
				<input type="date" class="form-control" id="search" placeholder="Buscar" > 
			</div>
		</div>
  		<div class="alert-zone"></div>
       	<hr>
        <table class="table table-striped sortable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha de registro</th>
                    <th>Cliente</th>
                   	<th>Descripcion</th>
                    <th>Prioridad</th>
                    <th>Estado</th>
                    <th>Cuenta total</th>
                    <th>Cuenta pagada</th>
                    <th>Veterinario</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="display_table">
            </tbody>
        </table>      
    </div>
   <!-- Modal para agregar -->
	<div class='modal fade' id='modal_insert'>	
	  <div class='modal-dialog modal-lg'>
	    <div class='modal-content'>
			<form id="frm_insert">
			<!-- Modal Header -->
			<div class='modal-header'>
				<h3 class='modal-title'>Agregar nueva consulta</h3>
				<div class="alert-zone-child"></div>
			</div>
			<!-- Modal body -->
			<div class='modal-body'>	
				<div class="form-group row">
					<div class="form-group col-md-7">
						<label for="IDCliente" >Seleccione cliente:</label>
						<select class="form-control" name="IDCliente" id="list_clie" required="">
						</select>
					</div>
					<div class="form-group col-md-5">
						<label for="nombre">Buscar:</label>
						<input type="search" class="form-control" name="nombre" id="search_clie" placeholder="Buscar cliente">
					</div>
				</div>
				<div class="form-group">
						<label>&nbsp;</label>
						<button class="btn btn-success" data-toggle='modal' data-target='#modal_insert_clie' id="insert_btn_child"><span class="glyphicon glyphicon-plus-sign"></span>Agregar un nuevo cliente</button>
					</div>
				<div class="form-group">
					<label for="descripcion">Descripción de la consulta:</label>
					<textarea class="form-control" name="descripcion" rows="3" required="" placeholder="Redacte una breve descripcion de la consulta"></textarea>
				</div>

				<div class="form-group">
					<label for="opc" >¿Desea programar la consulta para una fecha especifica?</label>
						<select class="form-control opc_fecha" name="opc">
						<option selected="" value="no">NO</option>
						<option value="si">SÍ</option>
						</select>
				</div>

				<div class="form-group row date-group">
					<div class="form-group col-md-6">
						<label for="fecha">Fecha</label>
						<input type="date" class="form-control" name="fecha">
					</div>
					<div class="form-group col-md-6">
						<label for="hora">Hora</label>
						<input type="time" class="form-control" name="hora">
					</div>
				</div>
				<div class="form-group range-group">
					<label for="prioridad">¿Qué tan urgente es la consulta?</label>
						<select class="form-control" name="prioridad">
						<option selected="" value="0">NO URGENTE (Acudir ese día o los proximos días)</option>
						<option value="1">URGENTE (Acudir ese mismo día o al siguiente máximo)</option>
						<option value="2">MUY URGENTE (Acudir inmediatamente)</option>
						</select>
				</div>
			</div> 
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel_insert">Cancelar</button>
				<input type="submit" class="btn btn-success" value="Guardar">
			</div>
			</form>
	    </div>
	  </div>
	</div>

	  <!-- Modal para agregar UN NUEVO CLIENTE -->
	<div class='modal' id='modal_insert_clie'>	
	  <div class='modal-dialog'>
	    <div class='modal-content'>
			<form id="frm_insert_clie" autocomplete="off">
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
						<input type="text" class="form-control" name="apodos" pattern="[a-z A-ZñÑáéíúóÁÉÍÓÚñÑ.üÜ,]{1,50}" placeholder="Apodo(s) (opcional)">
					</div>
				</div>

				<div class="form-group row">
					<div class="form-group col-md-7">
						<label for="municipio">Seleccionar dirección</label>
						<select class="form-control" name="direccion" required="" id="list_dir">
							<option value="" selected=""> -- Seleccionar -- </option>
						</select>
					</div>
					<div class="form-group col-md-5">
						<label for="search">Buscar</label>
						<input type="search" name="search" class="form-control" placeholder="Buscar" id="search_dir">
					</div>
				</div>

				<div class="form-group">
					<label for="referencias">Referencias de la vivienda</label>
					<textarea class="form-control" name="referencias" rows="2" pattern="[a-z A-ZñÑáéíúóÁÉÍÓÚñÑ.üÜ,]{4,100}" placeholder="Escriba algunas referencias para hallar el domicilio del cliente"></textarea>
				</div>

				<div class="form-group">
					<label for="telefono">Teléfono</label>
					<input type="text" class="form-control" name="telefono" pattern="[0-9]{10}" placeholder="10 digitos">
				</div>
				
			</div> 

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel_insert_clie">Cancelar</button>
				<input type="submit" class="btn btn-primary" value="Guardar">
			</div>
			</form>
	    </div>
	  </div>
	</div>

	<!-- Modal para actualizar-->
	<div class='modal fade' id='modal_update'>	
	  <div class='modal-dialog modal-lg'>
	    <div class='modal-content'>
			<form id="frm_update" autocomplete="off">
			<!-- Modal Header -->
			<div class='modal-header'>
				<h3 class='modal-title'>Actualizar información de la consulta</h3>
				<button type='button' class='close' data-dismiss='modal'>&times;</button>
			</div>
			<!-- Modal body -->
			<div class='modal-body'>
				<form id="frm_update">

				<div class="form-group row">
					<div class="form-group col-md-3">
						<label for="IDConsulta" >Clave única de la consulta</label>
						<input type="text" name="IDConsulta" class="form-control" readonly="">
					</div>
					
					<div class="form-group col-md-9">
						<label for="nombreCliente" >Nombre del cliente</label>
						<input type="text" name="nombreCliente" class="form-control" readonly="">
					</div>
					
				</div>
				<div class="form-group">
					<label for="descripcion">Descripción de la consulta:</label>
					<textarea class="form-control" name="descripcion" rows="3" required="" placeholder="Redacte una breve descripcion de la consulta"></textarea>
				</div>

				<div class="form-group">
					<label for="opc" >¿Desea programar la consulta para una fecha especifica?</label>
						<select class="form-control opc_fecha" name="opc">
						<option selected="" value="no">NO</option>
						<option value="si">SÍ</option>
						</select>
				</div>

				<div class="form-group row date-group">
					<div class="form-group col-md-6">
						<label for="fecha">Fecha</label>
						<input type="date" class="form-control" name="fecha">
					</div>
					<div class="form-group col-md-6">
						<label for="hora">Hora</label>
						<input type="time" class="form-control" name="hora">
					</div>
				</div>
				<div class="form-group range-group">
					<label for="prioridad">¿Qué tan urgente es la consulta?</label>
						<select class="form-control" name="prioridad">
						<option selected="" value="0">NO URGENTE (Acudir ese día o los proximos días)</option>
						<option value="1">URGENTE (Acudir ese mismo día o al siguiente máximo)</option>
						<option value="2">MUY URGENTE (Acudir inmediatamente)</option>
						</select>
				</div>
			</div> 


			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<input type="submit" class="btn btn-success" value="Guardar cambios">
			</div>
			</form>
	    </div>
	  </div>
	</div>

	<!-- Modal para eliminar-->
	<div class='modal' id='modal_delete'>	
	  <div class='modal-dialog'>
	    <div class='modal-content'>

			<!-- Modal Header -->
			<div class='modal-header'>
				<h3 class='modal-title'>
				<?php 
					if($_SESSION["tipo"] != "ADMINISTRADOR")
						echo 'Petición para elimiar consulta';
					else
						echo "Eliminar consulta";
				 ?>
				</h3>
				<!--<button type='button' class='close' data-dismiss='modal'>&times;</button>-->
			</div>

			<!-- Modal body -->
			<div class='modal-body'>
				<?php 
					if($_SESSION["tipo"] != "ADMINISTRADOR")
						echo '
							<div class="alert alert-warning" role="alert">
				  				El registro no se eliminara, solo se enviara una petición al usuario ADMINISTRADOR
				  				para que él se encargue de eliminar éste.
							</div>
						';
				 ?>
				<h5>¿Deseas borrar la consulta con clave <b><span id="IDConsulta"></span></b> del cliente <b><span id="nombreCliente"></span></b>?</h5>
				<?php 
					if($_SESSION["tipo"] != "ADMINISTRADOR")
						echo '				<div class="form-group">
					<label for="descripcion"> Escriba la razón por la cual quiere eliminar el registro </label>
					<textarea class="form-control" name="descripcion" placeholder="¿Por qué deseea borrar el registro?" id="descripcion"></textarea>
				</div>';
				 ?>
			</div> 

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel_delete">Cancelar</button>
				<?php 
					if($_SESSION["tipo"] == "ADMINISTRADOR")
						echo '<button type="button" class="btn btn-danger" data-dismiss="modal" id="borrar_btn">Borrar</button>';
					else
						echo '<button type="button" class="btn btn-info" data-dismiss="modal" id="borrar_btn">Mandar Petición</button>';
				 ?>
			</div>
	    </div> 
	  </div>
	</div>
</body>
</html>