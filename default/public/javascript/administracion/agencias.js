$(document).ready(function() {
	 var url_base=$("meta[name='base_url']").attr("content"); 

	if($('#tabla_agencias').length>0){
		$('#tabla_agencias').DataTable( { //para que la tabla funcione y su lenguaje en español
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

	$('.form-agencia').validator();

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

    $.post(url_base+"agencias/eliminar", {'idagen':id})
    .done(function(result){
      window.location.reload();
    })
    .fail(function(err){
      console.log('malo '+err);
    });
}