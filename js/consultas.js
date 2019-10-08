$(document).ready(function () {
	//Despliega la tabla de registros
	display("");

	//Buscar registro
	$("#search").change(function(event) {
		console.log($(this).val());
		display($(this).val());
	});
//-------------- Insertar un nuevo registro --------------------

	$("#btn-new").click(function() {
		$("#frm_insert .date-group").hide();
		$("#frm_insert select[name='opc']").val("no");
		$("#frm_insert input[name='fecha']").removeAttr('required');
		$("#frm_insert input[name='hora']").removeAttr('required');
		display_list_clie();
	});	

	$("#search_clie").keyup(function () {
		display_list_clie($(this).val());
	});
	
    $("#frm_insert .opc_fecha").on("change", function() {
        var val = $(this).val();
        if (val == "no") {
            $("#frm_insert .date-group").hide();
            $("#frm_insert .range-group").show();
            $("#frm_insert input[name='fecha']").removeAttr('required');
			$("#frm_insert input[name='hora']").removeAttr('required');
        } else {
            $("#frm_insert .date-group").show();
            $("#frm_insert .range-group").hide();
            $("#frm_insert input[name='fecha']").attr('required', 'required');
			$("#frm_insert input[name='hora']").attr('required', 'required');
        }
    });


	$("#frm_insert").submit(function(event) {
		event.preventDefault();
		$.ajax({
			url: 'php/consultas_insert.php',
			type: 'POST',
			data: $(this).serialize(),
			success: function (result) {
				if(result != "ERROR"){
					display();
					show_message_success("Registro guardado exitosamente!");
				}else{
					show_message_danger("Error en la base de datos. No se pudo guardar el registro.");
				}
			},
			error: function () {
				show_message_danger("Error en el script. No se pudo guardar el registro.");
			}
		});
		$(this).trigger('reset');
		$("#modal_insert").modal("hide");	
	});

	$("#cancel_insert").click(function (argument) {
		$('#frm_insert').trigger("reset");
	});


//------------ Insertar un nuevo registro DE UN CLIENTE ------------------------

	$('#insert_btn_child').click(function(e){
		display_list_dir();
	    e.preventDefault();
	    $('#modal_insert')
	        .on('hidden.bs.modal', function (e) {
	            $('#modal_insert_clie').modal('show');
	            $(this).off('hidden.bs.modal');
	        });

	});

	$("#search_dir").keyup(function () {
		display_list_dir($(this).val());
	});

	$('#frm_insert_clie').submit(function(event){
		event.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'php/clientes_insert.php',
			data: $(this).serialize(),
			success:function(IDCliente){
				if(IDCliente != "ERROR"){
					show_message_success_child("Cliente registrado correctamente. ¡Ya ha sido seleccionado!");
					$.ajax({
						type: 'POST',
						url: 'php/clientes_list_forid.php',
						data: {IDCliente: IDCliente},
						success: function (data) {
							$("#list_clie").html(data);
						}
					});
				}else
					show_message_danger_child("Error: No se pudo registrar al cliente.");
				
			}
		});
		$('#frm_insert_clie').trigger("reset");
		$('#modal_insert').on('hidden.bs.modal', function (e) {
			$('#modal_insert_clie').modal('hide');
			$(this).on('hidden.bs.modal');
		});;
		$("#modal_insert_clie").modal("hide");
	});

	$("#cancel_insert_clie").click(function (argument) {
		$('#frm_insert_clie').trigger("reset");
		$('#modal_insert').on('hidden.bs.modal', function (e) {
			$('#modal_insert_clie').modal('hide');
			$(this).on('hidden.bs.modal');
		});;
	});
    //----------------------------------------------------------
 
	//Actualizar registro
	$('#display_table').on("click", ".btn-primary", function () {
		$("#frm_update input[name='fecha']").removeAttr('required');
		$("#frm_update input[name='hora']").removeAttr('required');
		$.ajax({
			type: "POST",
			url: "php/consultas_register_tojson.php",
			data: {IDConsulta:$(this).attr("id")},
			success: function (str) {
				var data = JSON.parse(str);
				$("#frm_update input[name='IDConsulta']").val(data["IDConsulta"]);
				$("#frm_update input[name='nombreCliente']").val(data["nombreCliente"]);
				$("#frm_update textarea[name='descripcion']").val(data["descripcion"]);				
				if(data["prioridad"] == "PROGRAMADA"){
					$("#frm_update select[name='opc']").val("si");
					$(".date-group").show();
					$(".range-group").hide();
					$("#frm_update input[name='fecha']").val(data["fecha"]);
					$("#frm_update input[name='hora']").val(data["hora"]);
				}else{
					$("#frm_update select[name='opc']").val("no");
					$(".date-group").hide();
					$(".range-group").show();
					$("#frm_update select[name='prioridad']").val(data["prioridad"]);
				}
			}
		});
	});

	$("#frm_update .date-group").hide();
    $("#frm_update .opc_fecha").on("change", function() {
        var val = $(this).val();

        if (val == "no") {
            $("#frm_update .date-group").hide();
            $("#frm_update .range-group").show();
            $("#frm_update input[name='fecha']").removeAttr('required');
			$("#frm_update input[name='hora']").removeAttr('required');
        } else {
            $("#frm_update .date-group").show();
            $("#frm_update .range-group").hide();
            $("#frm_update input[name='fecha']").attr('required', 'required');
			$("#frm_update input[name='hora']").attr('required', 'required');
        }
    });

	$("#frm_update").submit(function (event) {
		event.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'php/consultas_update.php',
			data: $(this).serialize(),
			success:function(result){
				if(result != "ERROR"){
					display();
					show_message_success("Registro actualizado correctamente");
				}else 
					show_message_danger("Error en la base de datos. No se puedo actualizar el registro.");
			},
			error: function() {
				show_message_danger("Error en el script. No se puedo actualizar el registro.");
			}
		});
		$("#modal_update").modal("hide");
		$(this).trigger("reset");
	});

	//Eliminar registro
	$('#display_table').on("click", ".btn-danger", function () {
		$.ajax({
			type: "POST",
			url: "php/consultas_register_tojson.php",
			data: {IDConsulta:$(this).attr("id")},
			success: function (str) {
				var data = JSON.parse(str);
				$("span[id='IDConsulta']").append(data["IDConsulta"]);
				$("span[id='nombreCliente']").append(data["nombreCliente"]);
			}
		});
	});

	$('#cancel_delete').click(function () {
		$("span[id='IDConsulta']").empty();
		$("span[id='nombreCliente']").empty();
		$("span[id='descripcion']").empty();
	});

	$("#borrar_btn").click(function () {
		$.ajax({
			type: "POST",
			url: "php/consultas_delete.php",
			data: {IDConsulta: $("span[id='IDConsulta']").text(), descripcion: $("span[id='descripcion']").val()}
		});
		$("span[id='IDConsulta']").empty();
		$("span[id='nombreCliente']").empty();
		$("span[id='descripcion']").empty();
		display();
	});
});

function display(val) {
	$('#display_table').empty();
	$.ajax({
		type: 'GET',
		url: 'php/consultas_table.php',
		data: {fecha: val},
		success: function (table) {
			$('#display_table').append(table);
		}
	});
}

function display_list_clie(key) {
	$.ajax({
		type: 'POST',
		url: 'php/clientes_list.php',
		data: {nombre: key},
		success: function (data) {
			$('#list_clie').html(data);
		}
	});
}

function display_list_dir(key) {
	$.ajax({
		type: 'POST',
		url: 'php/direcciones_list.php',
		data: {nombre: key},
		success: function (data) {
			$('#list_dir').html(data);
		}
	});
}