$(document).ready(function () {
	//Despliega la tabla de registros
	display();

	//Buscar registro
	$("#search").keyup(function (){
		display($(this).val());
	});

//------------- Insertar un nuevo registro -----------------------------------------------------------
	$('#frm_insert').submit(function(event){
		event.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'php/inventario_insert.php',
			data: $(this).serialize(),
			success:function(result){
				if(result != "ERROR"){
					display();
					show_message_success("Registro guardado correctamente.");
				}else{
					show_message_danger("Error en la base de datos. No se pudo almacenar el registro");
				}
			},
			error: function () {
				show_message_danger("Error en el script. No se pudo almacenar el registro");
			}
		});
		$("#modal_insert").modal("hide");
		$('#frm_insert').trigger("reset");
	});

	$("#cancel_insert").click(function (argument) {
		$('#frm_insert').trigger("reset");
	});

//------------- Actualizar un registro ---------------------------------------------------------------
	$('#display_table').on("click", ".btn-primary", function () {
		$.ajax({
			type: "POST",
			url: "php/inventario_register_tojson.php",
			data: {codigo:$(this).attr("id")},
			success: function (str) {
				var data = JSON.parse(str);
				$("#frm_update input[name='codigo']").val(data["codigo"]);
				$("#frm_update textarea[name='nombre']").val(data["nombre"]);				
				$("#frm_update input[name='marca']").val(data["marca"]);
				$("#frm_update input[name='descripcion']").val(data["descripcion"]);
				$("#frm_update select[name='tipo']").val(data["tipo"]);
				$("#frm_update input[name='precioUnitario']").val(data["precioUnitario"]);
				$("#frm_update input[name='precioPublico']").val(data["precioPublico"]);
				$("#frm_update input[name='cantidadDisponible']").val(data["cantidadDisponible"]);
			}
		});
	});

	$("#frm_update").submit(function (event) {
		event.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'php/inventario_update.php',
			data: $(this).serialize(),
			success:function(result){
				if(result != "ERROR"){
					display();
					show_message_success("Registro actualizado correctamente.");
				}else
					show_message_danger("Error en la base de datos. No se puedo actualizar el registro.");
				
			}
		});
		$("#modal_update").modal("hide");
		$('#frm_update').trigger("reset");
	});

//------------- Eliminar un registro ---------------------------------------------------------------

	$('#display_table').on("click", ".btn-danger", function () {
		$.ajax({
			type: "POST",
			url: "php/inventario_register_tojson.php",
			data: {codigo:$(this).attr("id")},
			success: function (str) {
				var data = JSON.parse(str);
				$("span[id='nombre']").text(data["nombre"]);
				$("span[id='codigo']").text(data["codigo"]);
				$("span[id='marca']").text(data["marca"]);
			}
		});
	});

	$("#borrar_btn").click(function () {
		$.ajax({
			type: "POST",
			url: "php/inventario_delete.php",
			data: {codigo: $("span[id='codigo']").text()},
			success: function (result) {
				if(result != "ERROR"){
					display();
					show_message_success("Registro eliminado correctamente.");
				}else
					show_message_danger("Error en la base de datos. No se puedo eliminar el registro.");
			},
			error: function () {
				show_message_danger("Error en el script.");
			}
		});
	});
});

function display(key) {
	$.ajax({
		type: 'GET',
		url: 'php/inventario_table.php',
		data: {nombre: key},
		success: function (table) {
			$('#display_table').html(table);
		}
	});
}