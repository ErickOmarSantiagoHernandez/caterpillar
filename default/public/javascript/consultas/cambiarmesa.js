$(document).ready(function(){
	var url_base=$("meta[name='base_url']").attr("content"); // conseguimos el PUBLIC_PATH
	verificarMesa();
	$('.selectipo').on('change',function(event) { // funcion para llenar las mesas de acuerdo al tipo
		$('#selectmesa').empty();
		var idt= $('.selectipo').val();
		var idm=$('#selectmesa').attr('data-id');
		llenarSelect(idt,idm);
	});

	function verificarMesa(){// funciona para que se llene el select de mesa al cargar la pagina
		if($('.selectipo').val()!=0){
			var idt= $('.selectipo').val();
			var idm=$('#selectmesa').attr('data-id');
			llenarSelect(idt,idm);
		}
	}


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
	      		var opcion=$('<option/>').text("MESA A GENERAR").appendTo($('#selectmesa'));
	      		$('#selectmesa').attr('disabled', 'disabled');
	      	}
		}).fail(function(err){
			
		}); 
	}

	$('#form-exp').validator();//para aplicar la validacion de formularios
});