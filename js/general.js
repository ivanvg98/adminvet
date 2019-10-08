$(document).ready(function () {
	//Configuracion por tipo de usuario
	$.ajax({
		url: 'php/current_user_register_tojson.php',
		type: 'post',
		success: function (str) {
			if(str != "ERROR"){
				var data = JSON.parse(str);
				$(".dropdown-toggle").prepend(data["nombre"]);
				switch(String(data["tipo"])){
					case "ADMINISTRADOR": 
						$(".container-fluid .navbar-header .navbar-brand").attr('href', 'admin.php');
						if($("title").text() == "Empleados"){
							$(".nav.navbar-nav[class!='nav navbar-nav navbar-right']").append(''
								+'<li><a href="botiquines.php">Botiquines</a></li>'
								+'<li><a href="pedidos.php">Pedidos</a></li>'
								+'<li><a class="active" href="empleados.php">Empleados</a></li>'
							);
							$(".dropdown-menu").prepend('<li><a href="peticiones.php">Peticiones</a></li>');

						}
						else if($("title").text() == "Botiquines"){
							$(".nav.navbar-nav[class!='nav navbar-nav navbar-right']").append(''
								+'<li><a class="active" href="botiquines.php">Botiquines</a></li>'
								+'<li><a href="pedidos.php">Pedidos</a></li>'
								+'<li><a href="empleados.php">Empleados</a></li>'
							);
							$(".dropdown-menu").prepend('<li><a href="peticiones.php">Peticiones</a></li>');
						}
						else if($("title").text() == "Pedidos"){
							$(".nav.navbar-nav[class!='nav navbar-nav navbar-right']").append(''
								+'<li><a href="botiquines.php">Botiquines</a></li>'
								+'<li><a class="active" href="pedidos.php">Pedidos</a></li>'
								+'<li><a href="empleados.php">Empleados</a></li>'
							);
							$(".dropdown-menu").prepend('<li><a href="peticiones.php">Peticiones</a></li>');
						}
						else{
							$(".nav.navbar-nav[class!='nav navbar-nav navbar-right']").append(''
								+'<li><a href="botiquines.php">Botiquines</a></li>'
								+'<li><a href="pedidos.php">Pedidos</a></li>'
								+'<li><a href="empleados.php">Empleados</a></li>'
							);
							$(".dropdown-menu").prepend('<li><a href="peticiones.php">Peticiones</a></li>');
						}
					break;	
					case "RECEPCIONISTA":
						$(".container-fluid .navbar-header .navbar-brand").attr('href', 'recepcionista.php');
						
					break;
					case "VETERINARIO":
						$(".container-fluid .navbar-header .navbar-brand").attr('href', 'veterinario.php');
						
					break;
					default:
						window.location.assign("index.php");
					break;
				}
			}//else -> no existe una sesion

		}
	});
});

function show_message_danger(msj) {
	$(".alert-zone").html(''
        +'<div class="alert alert-danger" role="alert" id="message-danger">'
        +'	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' 
        +   msj
        +'</div>	');
}

function show_message_info(msj) {
	$(".alert-zone").html(''
        +'<div class="alert alert-info" role="alert" id="message-info">'
        +'	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' 
        +   msj
        +'</div>	');
}

function show_message_success(msj) {
	$(".alert-zone").html(''
        +'<div class="alert alert-success" role="alert" id="message-success">'
        +'	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' 
        +	msj
        +'</div>	');
}

function show_message_danger_child(msj) {
	$(".alert-zone-child").html(''
        +'<div class="alert alert-danger" role="alert" id="message-danger-child">'
        +'	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' 
        +   msj
        +'</div>	');
}

function show_message_info_child(msj) {
	$(".alert-zone-child").html(''
        +'<div class="alert alert-info" role="alert" id="message-info-child">'
        +'	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' 
        +   msj
        +'</div>	');
}

function show_message_success_child(msj) {
	$(".alert-zone-child").html(''
        +'<div class="alert alert-success" role="alert" id="message-success-child">'
        +'	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' 
        +	msj
        +'</div>	');
}

	