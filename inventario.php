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
    <title>Inventario</title>

    <!-- Dependencias bootstrap  y script externos -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/sorttable.js"></script>    
    
    <!-- Scripts de la aplicacion -->
    <script type="text/javascript" src="js/general.js"></script>
    <script type="text/javascript" src="js/inventario.js"></script>

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
				<li><a href="inventario.php" class="active">Inventario</a></li>
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
				<b class="title-table">Invetario general</b> <button type='button' class='btn btn-success' data-toggle='modal' data-target='#modal_insert' id='btn-new'> Agregar articulo</button>
			</div>
			<div class="container col-lg-6 text-right">
				<label for="search"> Buscar articulo: </label>
				<input type="search" class="form-control" id="search" placeholder="Buscar" > 
			</div>
		</div>
		<div class="alert-zone"></div>
        <hr> 
        
        <table class="table table-striped sortable">
            <thead>
                <tr>
                    <th>Clave única</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Presentación</th>
                    <th>Tipo</th>
                    <th>Precio Unitario</th>
                    <th>Precio Público</th>
                    <th>Cantidad Disponible</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="display_table">

            </tbody>
        </table>      
    </div>
   <!-- Modal para agregar -->
	<div class='modal' id='modal_insert'>	
	  <div class='modal-dialog'>
	    <div class='modal-content'>
			<form id="frm_insert" autocomplete="off">
			<!-- Modal Header -->
			<div class='modal-header'>
				<h3 class='modal-title'>Agregar un nuevo articulo</h3>
				<button type='button' class='close' data-dismiss='modal'>&times;</button>
			</div>

			<!-- Modal body -->
			<div class='modal-body'>
				<div class="form-group">
					<label for="codigo">Código de barras</label>
					<input type="text" class="form-control" name="codigo" required="" placeholder="Clave del medicamento">
				</div>
				<div class="form-group">
					<label for="Nombre">Nombre</label>
					<textarea class="form-control" name="nombre" required="" placeholder="Nombre o descripcion del producto" rows="1"></textarea>
				</div>

				<div class="form-group row">
					<div class="form-group col-md-6">
						<label for="marca">Marca</label>
						<input type="text" class="form-control" name="marca" required="" placeholder="Marca o distribuidor">
					</div>
					<div class="form-group col-md-6">
						<label for="descripcion">Presentación del articulo</label>
						<input type="text" class="form-control" name="descripcion" placeholder="Presentación del producto (ml, l, gr, kg, piezas, etc...)">
					</div>
				</div>

				<div class="form-group row">
					<div class="form-group col-md-6">
						<label for="precio">Precio unitario</label>
						<input type="number" name="precioUnitario" required="" class="form-control" min="0" step=".5" value="0.0">
					</div>

					<div class="form-group col-md-6">
						<label for="precio">Precio publico</label>
						<input type="number" name="precioPublico" required="" class="form-control" min="0" step=".5" value="0.0">
					</div>	
				</div>

				<div class="form-group row">
				<div class="form-group col-md-6">
					<label for="tipo">Tipo</label>
					<select required="" class="form-control" name="tipo">
						<option value="Material de curación">Material de curación</option>
						<option value="Desparacitante">Desparacitante</option>
						<option value="Antiflamatorio">Antiflamatorio</option>
						<option value="Vitaminas">Vitaminas</option>
						<option value="Anestesico">Anestesico</option>
						<option value="Hormonas">Hormonas</option>
						<option value="Antibioticos">Antibioticos</option>
						<option value="Vacunas">Vacunas</option>
						<option value="Otros">Otros</option>
					</select>
				</div>
				<div class="form-group col-md-6">
					<label for="cantidadDisponible">Cantidad Disponible</label>
					<input type="number" value="0" step="1" min="0" class="form-control" required="" name="cantidadDisponible">
				</div>
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
					<label for="codigo">Código de barras</label>
					<input type="text" class="form-control" name="codigo" required="" readonly="">
				</div>
				<div class="form-group">
					<label for="Nombre">Nombre</label>
					<textarea class="form-control" name="nombre" required="" placeholder="Nombre o descripcion del producto" rows="1"></textarea>
				</div>

				<div class="form-group row">
					<div class="form-group col-md-6">
						<label for="marca">Marca</label>
						<input type="text" class="form-control" name="marca" required="" placeholder="Marca o distribuidor">
					</div>
					<div class="form-group col-md-6">
						<label for="descripcion">Presentación del articulo</label>
						<input type="text" class="form-control" name="descripcion" placeholder="Presentación del producto (ml, l, gr, kg, piezas, etc...)">
					</div>
				</div>

				<div class="form-group row">
					<div class="form-group col-md-6">
						<label for="precio">Precio unitario</label>
						<input type="number" name="precioUnitario" required="" class="form-control" min="0" step=".5" value="0.0">
					</div>

					<div class="form-group col-md-6">
						<label for="precio">Precio publico</label>
						<input type="number" name="precioPublico" required="" class="form-control" min="0" step=".5" value="0.0">
					</div>	
				</div>

				<div class="form-group row">
				<div class="form-group col-md-6">
					<label for="tipo">Tipo</label>
					<select required="" class="form-control" name="tipo">
						<option value="Material de curación">Material de curación</option>
						<option value="Desparacitante">Desparacitante</option>
						<option value="Antiflamatorio">Antiflamatorio</option>
						<option value="Vitaminas">Vitaminas</option>
						<option value="Anestesico">Anestesico</option>
						<option value="Hormonas">Hormonas</option>
						<option value="Antibioticos">Antibioticos</option>
						<option value="Vacunas">Vacunas</option>
						<option value="Otros">Otros</option>
					</select>
				</div>
				<div class="form-group col-md-6">
					<label for="cantidadDisponible">Cantidad Disponible</label>
					<input type="number" value="0" step="1" min="0" class="form-control" required="" name="cantidadDisponible">
				</div>
				</div>
			</div> 
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<input type="submit" class="btn btn-primary" value="Guardar cambios">
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
				<h3 class='modal-title'>Eliminar registro</h3>
			</div>

			<!-- Modal body -->
			<div class='modal-body'>
				<h5>¿Desea borrar el articulo con nombre <b><span id="nombre"></span></b> de la marca <b><span id="marca"></span></b> con código de barras <b><span id="codigo"></span></b>?</h5>
			</div> 

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel_delete">Cancelar<button type="button" class="btn btn-danger" data-dismiss="modal" id="borrar_btn">Borrar</button>
			</div>
	    </div> 
	  </div>
	</div>
</body>
</html>