$(document).ready(function () {
    $("#pass2").on("blur", function() {
        if ($("#pass").val() != $(this).val()) {
            this.setCustomValidity("Las contraseñas no coinciden");
        } else {
            this.setCustomValidity("");
        }
    });
    $("input[type=submit]").attr("disabled", "disabled");
});

$(document).on('keyup', '#apass', function(){
    var pass = $(this).val();
    esCorrecta(pass);
});

function esCorrecta(pass) {
    $.ajax({ // se actualiza dinamicamente con AJAX
        url : 'php/user_searchpwd.php',
        type : 'POST',
        dataType : 'html',
        data : { pwd: pass },
        })

        .done(function(resultado){
            if(resultado == "si"){
                $("#info").text("La contraseña es correcta");
                $("input[type=submit]").removeAttr("disabled"); 
                $("#info").css({'color':'#45932CFF'});
            }
            else{
                $("#info").text("La contraseña es incorrecta");
                $("input[type=submit]").attr("disabled", "disabled");
                $("#info").css({'color':'#D1322DFF'});
            }
    })
}