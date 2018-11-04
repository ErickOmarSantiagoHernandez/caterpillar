function seleccionado(){
    var opt = $('#opcion').val();
    
   // alert(opt);
    if(opt=="1"){
        $('#selectfiscalia').show();
        $('#selectsiglas').hide();
        $('#opcion1').show();
        $('#boton').show();
    }else{
        if(opt=="2"){
            $('#selectfiscalia').hide();
            $('#selectsiglas').show();
            $('#opcion1').show();
            $('#boton').show();

        }else{
                $('#selectfiscalia').hide();
                $('#selectsiglas').hide();
                $('#opcion1').hide();
                $('#boton').hide();
        }
    }
}


$(document).ready(function() {
     $(".select2d").select2();
});