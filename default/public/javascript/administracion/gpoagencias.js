$(document).ready(function() {
	 var url_base=$("meta[name='base_url']").attr("content"); 

	if($('#tabla_grupo').length>0){
		$('#tabla_grupo').DataTable( { //para que la tabla funcione y su lenguaje en español
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

	$('#addgrupo').on('click', function(){ //mostrar el formulario de creacion
		$('#creargrupo').show('fast');
	});

	$('#cancel').on('click',function(){// ocultar el formulario de creacion
		$('#creargrupo').hide('fast');
	});

	$(document).on('click','.edit',function (e){  //para mostrar el formulario de edit
		configModalLoading();
		var ida=$(this).attr('data-id'); //obtiene el id de cada subprocuraduria
		$.get(url_base+"gpoagencias/getNombregrupo", {idgrupo:ida}) // busca esa subproduradura
        .done(function(result){
        	$('#modal_cargando').modal('hide');
          	$('#editargrupo').show('fast');
			$('.edit-grupo').attr('action', url_base+"gpoagencias/editar/"+ida); // le asigna la url correspondiente
			$('.igrupo').val(result[0].name);  // muestra el nombre actual de la agencia
			$('.iactivo').val(result[0].activa);
			$('.isub').val(result[0].sub);
        })
        .fail(function(err){
          $('#modal_cargando').modal('hide');
          console.log('malo '+err);
        });
	});

	$('#cancel-edit').on('click',function(){// ocultar el formulario de creacion
		$('#editargrupo').hide('fast');
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

    $.post(url_base+"gpoagencias/eliminar", {'idgrupo':id})
    .done(function(result){
      window.location.reload()
    })
    .fail(function(err){
      console.log('malo '+err);
    });
}