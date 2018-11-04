$(function(){
	var url_base=$("meta[name='base_url']").attr("content"); // conseguimos el PUBLIC_PATH
	
	$('.quitar').on('click', function(){
		$(this).parent().parent().remove();
	});

});