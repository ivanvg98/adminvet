$(document).ready(function () {
	//Despliega la tabla de registros
	display();

	//Buscar registro y mostrarlo en la tabla
	$("#search").keyup(function (){
		display($(this).val());
	});

//------------- Insertar un nuevo registro ---------------------------------------
	$.ajax({
		url: 'php/empleados_list.php',
		type: 'POST',
		data: {tipo: 'VETERINARIO'},
		success: function (list) {
			$("select[name='veterinario']").html(list);
			$("select[name='veterinario']").prepend(''+
				'<option selected="" value="null"> Sin asignar </option>');
		}
	});	

	$('#frm_insert').submit(function(e){
     	e.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'php/botiquines_insert.php',
			data: $(this).serialize(),
			success:function(){
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
			url: "php/botiquines_register_tojson.php",
			data: {numero:$(this).attr("id")},
			success: function (str) {
				var data = JSON.parse(str);
				$("#frm_update input[name='numero']").val(data["numero"]);
				$("#frm_update textarea[name='descripcion']").val(data["descripcion"]);
				if(data["veterinario"] == null	)
					$("#frm_update select[name='veterinario']").val('null');
				else
					$("#frm_update select[name='veterinario']").val(data["veterinario"]);									
			}
		});
	});

	$("#frm_update").submit(function (event) {
		event.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'php/botiquines_update.php',
			data: $(this).serialize(),
			success:function(result){
				if(result != "ERROR"){
					show_message_success("Registro actualizado correctamente");
					display();	
				}else{
					show_message_danger("Error en la base de datos. No se pudo actualizar el registro.");
				}
			},
			error: function () {
				show_message_danger("Error en el script. No se pudo actulizar el registro.");
				
			}
		});
		$('#frm_update').trigger("reset");
		$("#modal_update").modal("hide");
	});

//------------- Eliminar un registro ---------------------------------------
	$('#display_table').on("click", ".btn-danger", function () {
		$.ajax({
			type: "POST",
			url: "php/botiquines_register_tojson.php",
			data: {numero:$(this).attr("id")},
			success: function (str) {
				var data = JSON.parse(str);
				$("#frm_delete input[name='numero']").val(data["numero"]);
				$("#frm_delete input[name='descripcion']").val(data["descripcion"]);
			}
		});
	});

	$("#frm_delete").submit(function (event) {
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "php/botiquines_delete.php",
			data: $(this).serialize(),
			success: function (result) {
				if(result != "ERROR"){
					show_message_success("Registro eliminado exitosamente");
					display();	
				}else
					show_message_danger("Error en la base de datos. No se pudo eliminar el registro.");
			},
			error: function () {
				show_message_danger("Error en el script. No se puedo eliminar el registro.");
			}
		});
		$("#modal_delete").modal("hide");
	});

//------------- LISTA DE MEDICAMENTOS  ---------------------------------------

	$('#modal_list').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var numero = button.data('id');
		var modal = $(this);
		modal.find('.modal-title #numero').text(numero);
		display_listmedi(numero);
		modal.find('#btn_add').attr('data-id', numero);
	});

	$('#modal_add').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var numero = button.data('id');
		var modal = $(this);
		modal.find('#frm_add input[name="botiquin"]').val(numero);
		lista_medicamentos();
		$("#frm_add select[name='cantidad']").html('<option value=""> --Selecciona-- </option>');		
	});

	$("#frm_add select[name='cantidad']").on('focus', function(event) {
		$.ajax({
			url: 'php/inventario_register_tojson.php',
			type: 'POST',
			data: {codigo: $("#frm_add select[name='medicamento']").val()},
			success: function (str) {
				var data = JSON.parse(str);
				var cantidadDisponible = parseInt(data["cantidadDisponible"], 10);
				$("#frm_add select[name='cantidad']").empty();
				if(cantidadDisponible == 0)
					$("#frm_add select[name='cantidad']").html('<option value=""> No hay en existencia </option>');
				for (var i = 1; i <= cantidadDisponible; i++) {
					$("#frm_add select[name='cantidad']").append('<option value="'+i+'">'+i+'</option>');
				}
			}
		});
	});

	//Buscar medicamento 
	$("#frm_add input[name='search']").keyup(function() {
		lista_medicamentos($(this).val());
	});

	$("#frm_add").submit(function(event) {
		event.preventDefault();
		$.ajax({
			url: 'php/listamedicamentos_insert.php',
			type: 'POST',
			data: 	$(this).serialize(),
			success: function (result) {
				if(result != "ERROR"){
					display_listmedi($("#numero").text());
					show_message_success_child("Medicamento agregado");
				}else
					show_message_danger_child("Error en la base de datos");
			},
			error: function () {
					show_message_danger_child("Error en el script");
			}
		});
		$("#modal_add").modal("hide");
	});

	$("#frm_add select[name='medicamento']").change(function() {
		$("#frm_add select[name='cantidad']").html('<option value=""> --Selecciona-- </option>');		
	});


	$('#modal_add').on('hide.bs.modal', function (event) {
		$("#frm_add").trigger('reset');
	});


	$('#modal_delete_child').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var botiquin = button.data('botiquin');
		var medicamento = button.data('medicamento');
		var nombre = button.data('nombre');
		var modal = $(this);
		
		modal.find('#frm_delete_child input[name="botiquin"]').val(botiquin);
		modal.find('#frm_delete_child select[name="medicamento"]').html(''+
			'<option value="'+medicamento+'">'+nombre+'</option>');

		$.ajax({
			url: 'php/listamedicamentos_cantidad.php',
			type: 'POST',
			data: {botiquin: botiquin, medicamento: medicamento},
			success: function (str) {
				console.log(str);
				var data = JSON.parse(str);
				var cantidad = parseInt(data["cantidad"], 10);
				modal.find('#frm_delete_child select[name="cantidad"]').html(''+
					'<option value="todo"> Todo </option>');
/*				for (var i = cantidad-1; i > 0; i--) {
					modal.find('#frm_delete_child select[name="cantidad"]').append(''+
					'<option value="'+i+'">'+i+'</option>');
				}*/
			}
		});
	});

	$("#frm_delete_child").submit(function(event) {
		event.preventDefault();
		$.ajax({
			url: 'php/listamedicamentos_delete.php',
			type: 'POST',	
			data: $(this).serialize(),
			success: function (result) {
				if(result != "ERROR"){
					display_listmedi($("#frm_delete_child input[name='botiquin']").val());
					$("#modal_delete_child").modal("hide");
					show_message_success_child("Medicamento agotado correctamente");
				}else
					show_message_danger_child("Error en la base de datos. No se puedo agotar el medicamento");
			},
			error: function () {
				show_message_danger_child("Error en el script. No se puedo agotar el medicamento");
			}
		});
		
	});
});

//Funcion para mostrar los registros de la base de datos en tablas
function display(key) {
	$.ajax({
		type: 'GET',
		url: 'php/botiquines_table.php',
		data: {nombre: key},
		success: function (table) {
			$('#display_table').html(table);
		}
	});
}

//Funcion para mostrar los registros de la base de datos en tablas
function display_listmedi(key) {
	$.ajax({
		type: 'GET',
		url: 'php/listamedicamentos_table.php',
		data: {numero: key},
		success: function (table) {
			$('#display_table_list').html(table);
		}
	});
}

function lista_medicamentos(key){
	$.ajax({
		type: 'POST',
		url: 'php/inventario_list.php',
		data: {nombre: key},
		success: function (list) {
			$('#frm_add select[name="medicamento"]').html(list);
		}
	});
}