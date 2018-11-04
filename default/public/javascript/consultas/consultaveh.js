$(document).ready(function(){

	$('#form-consulta').validator();

	$('#btnbuscar').on('click',function(){
		$('#labelerror').text('');
		if(validarvacio() ){
			$('.form-horizontal').submit();
		}else{
			$('#labelerror').text('Debe completar al menos un campo del formulario');
		}
		
	});

	function validarvacio(){
		var lleno=false;
		$(".cuatro").each(function(){
        	if($(this).val()!=''){
        		lleno=true;
        	}
        });
        $(".ocho").each(function(){
        	if($(this).val()!=''){
        		lleno=true;
        	}
        });

        return lleno;
	}





	
});