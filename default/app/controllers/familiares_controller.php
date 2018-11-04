<?php 

if (!Session::has('id')) {
    Flash::valid('<div class="alert alert-warning" role="alert">
        <strong>Algo salio mal! </strong> La session expiró, vuelva a iniciar sesion
    </div>');   
	Redirect::to("principal/login");     
	exit();   
    }

Load::model('familiares');

class FamiliaresController extends AppController { 

     public $limit_params = FALSE;

     public function formcreacion($id,$idd=0){

     	View::template('templateciu');

     	$ciudadano= Load::model('ciudadanos')->find($id);
     	if ($ciudadano) {
     		$this->ciudadano = $ciudadano;

     		if ($idd!=0) {
     			$familiar=load::model('familiares')->find($idd);
     			if ($familiar) {
     				$this->familiar=$familiar;
     			}
     		}

		 	if (Input::haspost('familiar')) {
		 		if ((Input::haspost('idfamiliar'))&&(Input::post('idfamiliar'))!='') {
		 			$idf= Input::post('idfamiliar');
		 			$familiar=Load::model('familiares')->find($idf);
		 		}else{
		 			$familiar= new Familiares(); 
		 		}
		 		$datos=Input::post('familiar');
		 		$familiar->nombre = mb_strtoupper($datos['nombre'],'utf8');
		 		$familiar->paterno = mb_strtoupper($datos['paterno'],'utf8');
		 		$familiar->materno = mb_strtoupper($datos['materno'],'utf8');
        		$familiar->sexo=$datos['sexo'];
		 		$familiar->parentescos_id=$datos['parentesco'];
		 		$familiar->edociviles_id=$datos['estadocivil'];
		 		$familiar->ocupacion=mb_strtoupper($datos['ocupacion'],'utf8');
				$familiar->fechanacimiento=($datos['fechanacimiento']!='') ? date_format(date_create($datos['fechanacimiento']),'Y-m-d'):'';
				$familiar->ciudadanos_id=$ciudadano->id;
				$familiar->fechadenoresidir=($datos['fechadenoresidir']!='') ? date_format(date_create($datos['fechadenoresidir']),'Y-m-d'):'';
				$familiar->resideenpoblacion=$datos['resideenpoblacion'];
				if ((Input::haspost('idfamiliar'))&&(Input::post('idfamiliar'))!='') {
					if ($familiar->update()) {
						Flash::valid('<div class="alert alert-success" role="alert"><strong>Exito!</strong> Los datos del familiar han sido actualizados</div>');
					}else{
						Flash::valid('<div class="alert alert-danger" role="alert"><strong>Error!</strong> Los datos del familiar no fueron actualizados, vuelva a intentarlo</div>');  			
					}
				}elseif($familiar->save()) {
						Flash::valid('<div class="alert alert-success" role="alert"><strong>Exito!</strong> Los datos del familiar han sido guardados</div>');
				}else{
					Flash::valid('<div class="alert alert-danger" role="alert"><strong>Error!</strong> Los datos del familiar no fueron guardados, vuelva a intentarlo</div>');  			
				}
		 	}
     	}
     }

    public function formbusqueda(){
        View::template('templatebusqueda');

    }

    public function eliminar($id,$idd){
    	View::select(null);
    	View::template(null);
    	
    	$ciudadano = Load::model('ciudadanos')->find($id);
    	$familiar = Load::model('familiares')->find($idd);

    	if ($familiar) {
    		if ($familiar->delete()) {
				Flash::valid('<div class="alert alert-success" role="alert"><strong>Exito!</strong> El familiar fue eliminado correctamente</div>');    			
    		}else{
				Flash::valid('<div class="alert alert-danger" role="alert"><strong>Error!</strong> El familiar no fue eliminado</div>');    			   			
    		}
    	}else{
    		Flash::valid('<div class="alert alert-danger" role="alert"><strong>Error!</strong> El familiar no fue eliminado</div>'); 
    	}
    	
    	Redirect::to('familiares/formcreacion/'.$ciudadano->id);
    	$this->ciudadano = $ciudadano;

    }     
}
 ?>