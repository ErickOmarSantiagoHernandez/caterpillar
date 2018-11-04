    $('#resi').on('change', function(event) { //para mostrar el resto del formulario o no
        if($('#resi').val()==0){
            $('#fecharesi').attr('readonly', 'true');
        }else{
            $('#fecharesi').val('');
            $('#fecharesi').removeAttr('readonly')

        }
    });