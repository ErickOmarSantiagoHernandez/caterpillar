$(function(){
	var url_base=$("meta[name='base_url']").attr("content"); // conseguimos el PUBLIC_PATH
    $('#separar').on('click', function(){
        if ($('input[type=checkbox]:checked').length === 0) {
            $('#diverror').show('fast');
        }else{
           $('#form-separar').submit();
            $('#diverror').hide('fast');
        }
    });


    $('input[type=checkbox]').on('change', function() {
         $('#diverror').hide('fast');
    });

});




