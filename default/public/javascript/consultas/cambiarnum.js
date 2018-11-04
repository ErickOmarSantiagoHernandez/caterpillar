$(document).ready(function() {
	var url_base=$("meta[name='base_url']").attr("content"); // conseguimos el PUBLIC_PATH
	
	function verificarDuplicado(){ // verifca que los datos del expedienre no se repiten
		var num=$('.num').val();
		var age=$('#datos_agencia').val();
		var anio=$('.anio').val();
		var turno=$('.turno').val();
		if(num!="" && age!="" && anio!="" && turno!=""){
			$.post(url_base+'expedientestemp/verificaDuplicado',{'numero':num, 'agencia':age, 'anio':anio,'turno':turno})
			.done(function(result){
				$('.duplicado').hide('fast');
				$('#form-num').submit();
			}).fail(function(err){
				$('.duplicado').show('fast');
			}); 
		}
	}

	$('#btncambiar').on('click', function(){
		var dnum=$('.num').attr('data-num');
		var dage=$('#datos_agencia').attr('data-agen');
		var danio=$('.anio').attr('data-anio');
		var dturno=$('.turno').attr('data-turno');

		var num=$('.num').val();
		var age=$('#datos_agencia').val();
		var anio=$('.anio').val();
		var turno=$('.turno').val();
		 // si los datos del expediente actual son los mismos que estan en los input no valida
		if((dnum==num) && (dage==age) && (danio==anio) && (dturno==turno)){
			$('#form-num').submit();
		}else{
			verificarDuplicado();
		}

	});

	$('.num').on('keypress',function(){
		$('.duplicado').hide('fast');
	});

	$('#datos_agencia').on('change',function(){
		$('.duplicado').hide('fast');
	});

	$('.anio').on('keypress',function(){
		$('.duplicado').hide('fast');
	});

	$('.turno').on('keypress',function(){
		$('.duplicado').hide('fast');
	});


	$('#form-num').validator();//para aplicar la validacion de formularios


	$('.calendario').on('blur', function(){ // mascara de fecha
     var texto=$(this).val();
        if(texto!='' && texto.length<=8){
          var anio=texto.substring(4,8);
          var mes=texto.substring(2,4);
          var dia=texto.substring(0,2);

          var fecha=dia+'-'+mes+'-'+anio;

          $(this).val(fecha);
        }

  	});
});