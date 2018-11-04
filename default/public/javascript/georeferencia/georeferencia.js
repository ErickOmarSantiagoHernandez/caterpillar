$(document).ready(function() {
  

  var url_base=$("meta[name='base_url']").attr("content"); // conseguimos el PUBLIC_PATH

    var options = {  //llena el input con los nombres de delitos
    	url: function(frase){ return  url_base+"delitos/nombresDelitos?frase="+frase+"&format=json"} ,
    	getValue: function(element) {
      		return  element.name;
    	},
    	list: {
      		match: {
        	enabled: true
      		},
      		maxNumberOfElements:20,
      		onClickEvent: function(){
            $('#btndelito').removeAttr('disabled');
             $('#delitoid').parent().removeClass('has-error has-danger');
             $('#delitoid').siblings('.help-block').text('');
        		var id=$('#delitoname').getSelectedItemData().iddel;
            $('#delitoid').val(id);
        		
      		},
      		onKeyEnterEvent: function(){
            $('#btndelito').removeAttr('disabled');
             $('#delitoid').parent().removeClass('has-error has-danger');
             $('#delitoid').siblings('.help-block').text('');
      			 var id=$('#delitoname').getSelectedItemData().iddel;
        		  $('#delitoid').val(id);
            
      		},
    	}
  	};

	$("#delitoname").easyAutocomplete(options, 'appendTo', '.eventInsForm');
  $('.easy-autocomplete').css('width', '100%');
    
  $("#delitoname").blur(function(event) {//Al pasar el input de delitos verifica que no se quede vacio despues 
      if($("#delitoname").val()==""){    //de elegir uno con el easycomplete
          $('#delitoid').val(0);
      }else{
        if ($('#delitoid').val()=='0') {
          $('#delitoid').parent().addClass('has-error has-danger');
          $('#delitoid').siblings('.help-block').text('seleccione un delito valido');
          $('#btndelito').attr('disabled','true');
        }else{
          $('#delitoid').siblings('.help-block').text('');
          $('#delitoid').parent().removeClass('has-error has-danger');
          $('#btndelito').removeAttr('disabled');
        }
      }
  });

  $("#delitoname").keypress(function(){ // siempre que se escribe en el input se resetea el id
      $('#delitoid').val(0);
  });


    $('#date_timepicker_start').datetimepicker({
        format:'Y/m/d',
        onShow:function( ct ){
          this.setOptions({
            maxDate:$('#date_timepicker_end').val()?$('#date_timepicker_end').val():false
          })
        },
        datepicker:true,timepicker:false,format:'Y-m-d',editable:true
     });

     $('#date_timepicker_end').datetimepicker({
        format:'Y/m/d',
        onShow:function( ct ){
         this.setOptions({
          minDate:$('#date_timepicker_start').val()?$('#date_timepicker_start').val():false
         })
        },
        datepicker:true,timepicker:false,format:'Y-m-d',editable:true

      });

     var options1 = {  //llena el input con los nombres de municipios
      url: function(frase){ return  url_base+"municipios/nombresmunicipio?frase="+frase+"&format=json"} ,
      getValue: function(element) {
          return  element.name;
      },
      list: {
          match: {
          enabled: true
          },
          maxNumberOfElements:20,
          onClickEvent: function(){
            $('#btnmuni').removeAttr('disabled');
            $('#municipioid').parent().removeClass('has-error has-danger');
            $('#municipioid').siblings('.help-block').text('');
            var id=$('#municipioname').getSelectedItemData().idmun;
            $('#municipioid').val(id);
           
          },
          onKeyEnterEvent: function(){
            $('#btnmuni').removeAttr('disabled');
            $('#municipioid').parent().removeClass('has-error has-danger');
            $('#municipioid').siblings('.help-block').text('');
            var id=$('#municipioname').getSelectedItemData().idmun;
            $('#municipioid').val(id);
            
          },
      }
    };

  $("#municipioname").easyAutocomplete(options1, 'appendTo', '.eventInsForm');
  $('.easy-autocomplete').css('width', '100%');

  $("#municipioname").blur(function(event) {//Al pasar el input de delitos verifica que no se quede vacio despues 
      if($("#municipioname").val()==""){    //de elegir uno con el easycomplete
          $('#municipioid').val(0);
      }else{
        if ($('#municipioid').val()=='0') {
          $('#municipioid').parent().addClass('has-error has-danger');
          $('#municipioid').siblings('.help-block').text('seleccione un municipio valido');
          $('#btnmuni').attr('disabled','true');
        }else{
          $('#municipioid').siblings('.help-block').text('');
          $('#municipioid').parent().removeClass('has-error has-danger');
          $('#btnmuni').removeAttr('disabled');
        }
      }
  });

  $("#municipioname").keypress(function(){ // siempre que se escribe en el input se resetea el id
      $('#municipioid').val(0);
  });

  $('#formulario2').validator();
  $('#formulario3').validator();
});