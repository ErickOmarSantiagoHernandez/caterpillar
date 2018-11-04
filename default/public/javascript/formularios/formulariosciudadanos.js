function justNumbers(e){ //metodo para que el input solo acepte numeros 
	    var keynum = window.event ? window.event.keyCode : e.which;
	    if ((keynum == 8) || (keynum == 46))
	    return true;
	     
	    return /\d/.test(String.fromCharCode(keynum));
}

    $('#agua').on('change', function(event) { //para mostrar el resto del formulario o no
        if($('#agua').val()==0){
            $('#resagua').attr('readonly', 'true');
        }else{
            $('#resagua').val('');
            $('#resagua').removeAttr('readonly')

        }
    });

    $('#panteon').on('change', function(event) { //para mostrar el resto del formulario o no
        if($('#panteon').val()==0){
            $('#respanteon').attr('readonly', 'true');
        }else{
            $('#respanteon').val('');
            $('#respanteon').removeAttr('readonly')

        }
    });