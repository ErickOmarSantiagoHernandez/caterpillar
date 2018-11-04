$(function(){
	var url_base=$("meta[name='base_url']").attr("content"); // conseguimos el PUBLIC_PATH
	$('.form-recibir').validator();//para aplicar la validacion de formularios


	 function verificarDuplicado(){ // verifca que los datos del expedienre no se repiten
		var num=$('.num').val();
		var age=$('#datos_agencia').val();
		var anio=$('.anio').val();
		var turno=$('.turno').val();
		if(num!="" && age!="" && anio!="" && turno!=""){
			$.post(url_base+'expedientestemp/verificaDuplicado',{'numero':num, 'agencia':age, 'anio':anio,'turno':turno})
			.done(function(result){
				$('.duplicado').hide('fast');
				$('.principal').css('border','');
				$('.btnrecibir').removeAttr('disabled');
			}).fail(function(err){
				$('.duplicado').show('fast');
				$('.principal').css('border','solid 1px red');
				$('.btnrecibir').attr('disabled','true');
			}); 
		}
	}

	$('.num').on('blur',function(){verificarDuplicado()});
	$('#datos_agencia').on('change',function(){verificarDuplicado()});
	$('.anio').on('blur',function(){verificarDuplicado()});
	$('.turno').on('blur',function(){verificarDuplicado()});

	if ($('.existe').length) {
	  $('.btnrecibir').remove();
	}/* else {
	  $('.btnrecibir').removeAttr('disabled');
	}*/


	$('.selectipo').on('change',function(event) { // funcion para llenar las mesas de acuerdo al tipo
		$('#selectmesa').empty();
		var idt= $('.selectipo').val();
		var idm=$('#selectmesa').attr('data-id');
		llenarSelect(idt,idm);
	});


	function llenarSelect(id,idm){ //funcion para llenar el select de mesas 
		$.get(url_base+'mesas/getMesasTipo',{idtipo:id}).done(function(result){
			
			if(JSON.parse(result).length > 0){ //comprobar si el arreglo viene vacio o no para deshabilitarlo
				$('#selectmesa').removeAttr('disabled');
				$.each(JSON.parse(result), function(k, v) {
	        		var opcion=$('<option/>').val(v.idmesa).text(v.mesa).appendTo($('#selectmesa'));
	        		if(idm!=""){
	        			if(opcion.val()==idm){
	        				opcion.attr('selected', 'true'); //seleccionar el que ya tiene
	        			}
	        		}
	      		});  
	      	}else{
	      		$('#selectmesa').attr('disabled', 'disabled');
	      	}
		}).fail(function(err){
			
		}); 
	}
});