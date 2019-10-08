$(document).ready(function () {
	//Despliega la tabla de registros
	display();

	//Buscar registro y mostrarlo en la tabla
	$("#search").keyup(function (){
		display($(this).val());
	});

	//Mostrar las direcciones disponibles en un select
	display_list_dir();

	//Buscar direcciones disponibles y mostrarlas en el select
	$(".search_dir").keyup(function () {
		display_list_dir($(this).val());
	});

//------------- Insertar un nuevo registro ---------------------------------------

	$("#btn-new").click(function () {
		
	});

	$('#frm_insert').submit(function(e){
     	e.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'php/clientes_insert.php',
			data: $(this).serialize(),
			success:function(str){
				show_message_success("Registro guardado exitosamente!");
				display();
			}
		});
		$('#modal_insert').modal('hide')
		$('#frm_insert').trigger("reset");
		$("#message-success").empty();
	});

	$("#cancel_insert").click(function (argument) {
		$('#frm_insert').trigger("reset");
	});

//------------- Actualizar un registro ---------------------------------------
	$('#display_table').on("click", ".btn-primary", function () {
		$.ajax({
			type: "POST",
			url: "php/clientes_register_tojson.php",
			data: {IDCliente:$(this).attr("id")},
			success: function (str) {
				var data = JSON.parse(str);
				$("#frm_update input[name='IDCliente']").val(data["IDCliente"]);
				$("#frm_update input[name='nombre']").val(data["nombre"]);				
				$("#frm_update input[name='apodos']").val(data["apodos"]);
				$("#frm_update select[name='direccion']").val(data["direccion"]);
				$("#frm_update input[name='telefono']").val(data["telefono"]);
				$("#frm_update textarea[name='referencias']").val(data["referencias"]);
			}
		});
	});

	$("#frm_update").submit(function (event) {
		event.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'php/clientes_update.php',
			data: $('#frm_update').serialize(),
			success:function(result){
				if(result != "ERROR"){
					show_message_info("Registro actualizado correctamente");
					display();	
				}else{
					show_message_danger("¡Hubo un error al momento de guardar el registro!");
				}
			},
			error: function () {
				show_message_danger("¡Hubo un error al momento de guardar el registro!");
				
			}
		});
		$('#frm_update').trigger("reset");
		$("#modal_update").modal("hide");
	});

	//------------- Eliminar un registro ---------------------------------------
	$('#display_table').on("click", ".btn-danger", function () {
		$.ajax({
			type: "POST",
			url: "php/clientes_register_tojson.php",
			data: {IDCliente:$(this).attr("id")},
			success: function (str) {
				var data = JSON.parse(str);
				$("#frm_delete input[name='IDCliente']").val(data["IDCliente"]);
				$("#frm_delete input[name='nombre']").val(data["nombreCompleto"] + " | " +data["direccionCompleta"]);
			}
		});
	});


	$("#frm_delete").submit(function (event) {
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "php/clientes_delete.php",
			data: $(this).serialize(),
			success: function (str) {
				console.log(str);
				show_message_danger("Registro eliminado exitosamente");
				display();
			}
		});
		$("#modal_delete").modal("hide");
	});
});

//Funcion para mostrar los registros de la base de datos en tablas
function display(key) {
	$.ajax({
		type: 'GET',
		url: 'php/clientes_table.php',
		data: {nombre: key},
		success: function (table) {
			$('#display_table').html(table);
		}
	});
}

//Mostrar los registros de las direcciones en un select
function display_list_dir(key) {
	$.ajax({
		type: 'POST',
		url: 'php/direcciones_list.php',
		data: {nombre: key},
		success: function (data) {
			$('.list_dir').html(data);
		}
	});
}