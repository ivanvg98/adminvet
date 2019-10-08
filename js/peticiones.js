$(document).ready(function () {
    //Despliega la tabla de registros
    display();

    //Buscar registro
    $("#search").keyup(function (){
        $('#display_table').empty();
        $.ajax({
            type: 'GET',
            url: 'php/peticiones_table.php',
            data: {fecha: $("#search").val()},
            success: function (table) {
                $('#display_table').append(table);
            }
        });
    });

    //Denegar peticion
    $('#display_table').on("click", ".btn-primary", function () {
        $.ajax({
            type: "POST",
            url: "php/peticiones_register_tojson.php",
            data: {numero:$(this).attr("id"),},
            success: function (str) {
                var data = JSON.parse(str);
                $("#modal_denegar .numero").append(data["numero"]);
                $("#modal_denegar .table").append(data["table"]);
                $("#modal_denegar .ID").append(data["ID"]);
            }
        });
    });

    $("#denegar_btn").click(function () {
        $.ajax({
            type: "POST",
            url: "php/delete_master.php",
            data: {numero: $("#modal_denegar .numero").text(), estado: "DENEGADO"},
            success: function (str) {
                console.log(str);
            }
        });
        $("#modal_denegar .numero").empty();
        $("#modal_denegar .table").empty();
        $("#modal_denegar .ID").empty();
        display();
    });

    $('#cancel_denegar').click(function () {
        $("#modal_denegar .numero").empty();
        $("#modal_denegar .table").empty();
        $("#modal_denegar .ID").empty();
    });

    //Eliminar registro
    $('#display_table').on("click", ".btn-danger", function () {
        $.ajax({
            type: "POST",
            url: "php/peticiones_register_tojson.php",
            data: {numero:$(this).attr("id")},
            success: function (str) {
                var data = JSON.parse(str);
                $("#modal_delete .numero").append(data["numero"]);
                $("#modal_delete .table").append(data["table"]);
                $("#modal_delete .ID").append(data["ID"]);
            }
        });
    });

    $("#borrar_btn").click(function () {
        $.ajax({
            type: "POST",
            url: "php/delete_master.php",
            data: {numero: $("#modal_delete .numero").text(), estado: "ELIMINAR"}
        });
        $("#modal_delete .numero").empty();
        $("#modal_delete .table").empty();
        $("#modal_delete .ID").empty();
        display();
    });

    $('#cancel_delete').click(function () {
        $("#modal_delete .numero").empty();
        $("#modal_delete .table").empty();
        $("#modal_delete .ID").empty();
    });
});

//Funcion para mostrar la tabla de peticiones 
function display() {
    $('#display_table').empty();
    $.ajax({
        type: 'GET',
        url: 'php/peticiones_table.php',
        success: function (table) {
            $('#display_table').append(table);
        }
    });
}