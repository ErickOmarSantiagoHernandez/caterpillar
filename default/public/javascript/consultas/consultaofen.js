$(document).ready(function(){

	 $('#form-consulta').validator();

	$('#btnbuscar').on('click',function(){
		validarvacio();
	});

	function validarvacio(){
		$('#labelerror').text('');
		if($('.nombre').val()=='' && $('.apat').val()=='' && $('.amat').val()=='' && $('.alias').val()==''){
			$('#labelerror').text('Debe completar al menos un campo del formulario');
		}else{
			$('.form-horizontal').submit();
			
		}
	}
	
	
});