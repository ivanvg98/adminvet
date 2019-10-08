$(document).ready(function () {
	//Despliega la tabla de registros
	display();
	//Buscar registro
	$("#search").keyup(function (){
		display($(this).val());
	});

//------------- Insertar un nuevo registro ---------------------------------------

	$("#frm_insert").submit(function(event) {
		event.preventDefault();
		$.ajax({
			url: 'php/empleados_insert.php',
			type: 'POST',
			data: $(this).serialize(),
		})
		.done(function(result) {
			$("#modal_insert").modal("hide");
			$(this).trigger("reset");
			if(result != "ERROR"){
				display();
				show_message_success("Registro guardado correctamente");
			}
			else
				show_message_danger("¡Hubo un error al momento de almacenar el registro!");
		})
		.fail(function() {
			show_message_danger("¡Hubo un error al momento de almacenar el registro!");
		});
		
	});

	$("#user").on('change', function(){
	    var nickname = $(this).val();
	    var user = document.querySelector("#user");
	    $.ajax({
	        url : 'php/empleados_register_tojson.php',
	        type : 'POST',
	        dataType : 'html',
	        data : { user: nickname },
	        success: function (str) {
	        	var data = JSON.parse(str);
	        	if(data["user"] == null){
	        		$("#disponible").text("Disponible");
		            $("#disponible").css({'color':'#45932CFF'});
		            user.setCustomValidity("");
		        }
		        else{
		            $("#disponible").text("No disponible");
		            $("#disponible").css({'color':'#D1322DFF'});
		            user.setCustomValidity("El nombre de usuario ya ha sido utilizado. Elige uno nuevo");
			    }
			}
	    });
	});

	$("#frm_insert input[name='password2']").on("blur", function(){
	if ($("#frm_insert input[name='password']").val() != $(this).val()) {
	        this.setCustomValidity("Las contraseñas no coinciden");
	    } else {
	        this.setCustomValidity("");
	    }
	});

	$("#cancel_insert").click(function () {
		$('#frm_insert').trigger("reset");
	});


//------------- Actualizar registro ---------------------------------------
	
	$('#display_table').on("click", ".btn-primary", function () {
		$('#group_password').hide();
		$("#frm_update input[name='password']").removeAttr('required');
		$("#frm_update input[name='password2']").removeAttr('required');
		$("#frm_update input[name='password']").val("")
		$("#frm_update input[name='password2']").val("")
		$("#frm_update select[name='opc']").val("NO");
		$.ajax({
			type: "POST",
			url: "php/empleados_register_tojson.php",
			data: {user:$(this).attr("id")},
			success: function (str) {
				var data = JSON.parse(str);
				$("#frm_update input[name='user']").val(data["user"]);
				$("#frm_update input[name='nombre']").val(data["nombre"]);				
				$("#frm_update input[name='apodos']").val(data["apodos"]);
				$("#frm_update select[name='direccion']").val(data["direccion"]);
				$("#frm_update input[name='telefono']").val(data["telefono"]);
				$("#frm_update textarea[name='referencias']").val(data["referencias"]);
			}
		});
	});

	$("#frm_update select[name='opc']").on('change', function() {
		if($(this).val() == "SI"){
			$("#frm_update input[name='password']").attr('required', 'required');
			$("#frm_update input[name='password2']").attr('required', 'required');
			$("#group_password").show();
		}else if($(this).val() == "NO"){
			$("#group_password").hide();
			$("#frm_update input[name='password']").removeAttr('required');
			$("#frm_update input[name='password2']").removeAttr('required');
		}
	});

	$("#frm_update input[name='password2']").on("blur", function(){
		if ($("#frm_update input[name='password']").val() != $(this).val()) {
	        this.setCustomValidity("Las contraseñas no coinciden");
	    } else {
	        this.setCustomValidity("");
	    }	    	
	});

	$("#frm_update").submit(function(event) {
		event.preventDefault();
		$.ajax({
			url: 'php/empleados_update.php',
			type: 'POST',
			data: $(this).serialize(),
		})
		.done(function(result) {
			$(this).trigger('reset');
			$("#modal_update").modal("hide");
			if(result != "ERROR") {
				display();
				show_message_success("Registro actualizado correctamente");
			}
			else
				show_message_danger("¡Hubo un error! No se pudo actualizar el registro.");
		})
		.fail(function() {
			show_message_danger("¡Hubo un error! No se pudo actualizar el registro.");
		});
	});

//------------- Eliminar registro ---------------------------------------

	$('#display_table').on("click", ".btn-danger", function () {
		$.ajax({
			type: "POST",
			url: "php/empleados_register_tojson.php",
			data: {user:$(this).attr("id")},
			success: function (str) {
				var data = JSON.parse(str);
				$("span[id='nombre']").text(data["nombre"]);
				$("span[id='user']").text(data["user"]);
			}
		});
	});

	$("#borrar_btn").click(function () {
		$.ajax({
			type: "POST",
			url: "php/empleados_delete.php",
			data: {user: $("span[id='user']").text()},
			success: function (result) {
				if(result != "ERROR"){
					display();
					show_message_success("Registro eliminado exitosamente");
				}else 
					show_message_danger("No puede eliminar este registro. Consulte con el administrador del sistema.");
			},
			error:function () {
				show_message_danger("Hubo un error. No se pudo eliminar el registro");
			}
		});
		
	});
});

function display(key) {
	$.ajax({
		type: 'GET',
		url: 'php/empleados_table.php',
		data: {nombre: key},
		success: function (table) {
			$('#display_table').html(table);
		}
	});
}