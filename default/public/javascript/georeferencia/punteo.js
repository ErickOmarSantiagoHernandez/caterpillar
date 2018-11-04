function seleccionado(){
    var opt = $('#opcion').val();
    
   // alert(opt);
    if(opt=="1"){
        $('#selectmunicipio').show();
        $('#selectdistrito').hide();
        $('#selectregion').hide();
    }else{
        if(opt=="2"){
            $('#selectmunicipio').hide();
            $('#selectdistrito').show();
            $('#selectregion').hide();
        }else{
            if (opt=="3") {
                $('#selectmunicipio').hide();
                $('#selectdistrito').hide();
                $('#selectregion').show();
            }
        }
    }
}
