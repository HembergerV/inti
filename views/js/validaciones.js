    $(document).ready(Principal);
    function Principal(){
        var flag1 = true;
        $(document).on('keypress','[id="telefono"]',function(e){
            if($(this).val().length == 4 && flag1) {
                $(this).val($(this).val()+"-");
                flag1 = true;
            }
        });
    };
    $(document).ready(cedula);
    function cedula(){
        var flag1 = true;
        $(document).on('keypress','[id="cedula"]',function(e){
            if($(this).val().length == 1 && flag1 && $(this).val()== "V" || $(this).val()== "E") {
                $(this).val($(this).val()+"-");
                flag1 = false;
            }
        });
    }
$(document).ready(cedula);
    function cadenaText(e) {
        tecla = (document.all) ? e.keyCode : e.which;

        //Tecla de retroceso para borrar, siempre la permite
        if (tecla == 8) {
            return true;
        }

        // Patron de entrada, en este caso solo acepta numeros y letras
        patron = /[A-Za-z]/;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);
    }