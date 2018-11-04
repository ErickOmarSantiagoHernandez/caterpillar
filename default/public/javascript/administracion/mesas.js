$(document).ready(function() {
	 var url_base=$("meta[name='base_url']").attr("content"); 

	if($('#tabla_mesas').length>0){
		$('#tabla_mesas').DataTable( { //para que la tabla funcione y su lenguaje en español
	        "language": {
	            "lengthMenu": "Mostrar _MENU_ registros",
	            "zeroRecords": "No hay resultados",
	            "info": "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
	            "infoEmpty": "No hay registros disponibles",
	            "infoFiltered": "(Filtrando _MAX_  del total de registros)",
	            "search":         "Buscar: ",
			    "paginate": {
			        "first":      "Primero",
			        "last":       "Ultimo",
			        "next":       "Siguiente",
			        "previous":   "Anterior"
			    },
	        }
	    } );
	}

	$('#addmesa').on('click', function(){ //mostrar el formulario de creacion
		$('#crearsub').show('fast');
	});

	$('#cancel').on('click',function(){// ocultar el formulario de creacion
		$('#crearsub').hide('fast');
	});

	$(document).on('click','.edit',function (e){  //para mostrar el formulario de edit
		configModalLoading();
		var idmesas=$(this).attr('data-id'); //obtiene el id de cada mesa
		$.get(url_base+"mesas/getNombremesa", {idmesa:idmesas}) // busca esa mesa
        .done(function(result){
        	$('#modal_cargando').modal('hide');
          	$('#editarsub').show('fast');
			$('.edit-sub').attr('action', url_base+"mesas/editar/"+idmesas); // le asigna la url correspondiente
			$('.mesa').val(result[0].name);  // muestra el nombre actual de la mesa
			$('.clave').val(result[0].clave);
			$('.tipo').val(result[0].tipo);
			$('.activa').val(result[0].activa);
        })
        .fail(function(err){
    	  $('#modal_cargando').modal('hide');
          console.log('malo '+err);
        });
	});

	$('#cancel-edit').on('click',function(){// ocultar el formulario de creacion
		$('#editarsub').hide('fast');
	});

	

	$(document).on('click',function(){
		 $('[data-toggle="popover"]').popover();
	});


 	

});

function cerrarPop(event){
    var elemento= event.target;
    var id=elemento.attributes['data-id'].value;
    $(".quitar-"+id).click();
};

function eliminar(event){
    var elemento=event.currentTarget;
    var id=elemento.id;
    var url_base=$("meta[name='base_url']").attr("content");

    $.post(url_base+"mesas/eliminar", {'idmesa':id})
    .done(function(result){
      window.location.reload()
    })
    .fail(function(err){
      console.log('malo '+err);
    });
}