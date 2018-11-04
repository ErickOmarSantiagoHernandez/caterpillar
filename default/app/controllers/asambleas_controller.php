<?php 

if (!Session::has('id')) {
    Flash::valid('<div class="alert alert-warning" role="alert">
        <strong>Algo salio mal! </strong> La session expiró, vuelva a iniciar sesion
    </div>');   
    Redirect::to("principal/login");    
    exit();    
}

Load::models('asambleas','asambleaciudadano');
class AsambleasController extends AppController { 

     public $limit_params = FALSE;

     public function formcreacion($id){
     	view::template('templatebusqueda');

        if ($id=='4ZY2') {
            $asamblea = new Asambleas();
            $asamblea->activo ='N';
            $asamblea->save();
            $this->asamblea = $asamblea;
        }else{
            $asamblea = Load::model('asambleas')->find($id);
            if ($asamblea) {
                $this->asamblea = $asamblea;
            }
        }     
     	if (Input::hasPost('asamblea')) {
     		$datos = Input::post('asamblea');	
     		$asamblea = Load::model('asambleas')->find($asamblea->id);

     		$asamblea->tipo = mb_strtoupper($datos['tipo'],'utf8');
     		$asamblea->descripcion = mb_strtoupper($datos['descripcion'],'utf8');
     		$asamblea->organiza = mb_strtoupper($datos['organiza'],'utf8');
    		$asamblea->fechaasamblea=($datos['fecha']!='') ? date_format(date_create($datos['fecha']),'Y-m-d'):'';
            $asamblea->activo = 'S';
            $asamblea->fechacreacion=date('Y-m-d H:i:s');
     		if ($asamblea->update()) {
     			Flash::valid('<div class="alert alert-success" role="alert"><strong>Exito!</strong> Los datos del asamblea han sido registrado correctatemente</div>');
    	    	Redirect::to('asambleas/formcreacion/'.$asamblea->id);
     		}else{
     			Flash::valid('<div class="alert alert-red" role="alert"><strong>Error!</strong> Los datos del asamblea no han sido registrados</div>');
    	    	Redirect::to('principal/nodisponible');
     		}
     	}

     }

    public function desactivar($id){
        view::select(null);
        view::template(null);

        $asamblea = Load::model('asambleas')->find($id);
        if ($asamblea) {
            $asamblea->activo='N';
            if ($asamblea->update()) {
                Flash::valid('<div class="alert alert-success" role="alert"><strong>Exito!</strong> La asamblea ha sido desactivada correctatemente</div>');
                Redirect::to('asambleas/formbusqueda/');
            }else{
                Flash::valid('<div class="alert alert-red" role="alert"><strong>Error!</strong> La asamblea no fue sido desactivada</div>');
                Redirect::to('asambleas/formbusqueda/');
            }
        }
    }

    public function activar($id){
        view::select(null);
        view::template(null);

        $asamblea = Load::model('asambleas')->find($id);
        if ($asamblea) {
            $asamblea->activo='S';
            if ($asamblea->update()) {
                Flash::valid('<div class="alert alert-success" role="alert"><strong>Exito!</strong> La asamblea ha sido activada correctatemente</div>');
                Redirect::to('asambleas/formbusqueda/');
            }else{
                Flash::valid('<div class="alert alert-red" role="alert"><strong>Error!</strong> La asamblea no fue sido activada</div>');
                Redirect::to('asambleas/formbusqueda/');
            }
        }
    }    

    public function formbusqueda(){
        View::template('templatebusqueda');

    }

    public function formlista($id){
        View::template('templatebusqueda');

        $asamblea = Load::model('asambleas')->find($id);
        if ($asamblea){
            $this->asamblea = $asamblea;
        }
            if ((Input::hasPost('listasistencia'))&&(Input::hasPost('idasamblea'))) {
                $ciudadanos=Input::post('listasistencia');
                $idasamblea=Input::post('idasamblea');
                foreach($ciudadanos as $ciudadano){
                    if (!(Load::model('asambleaciudadano')->exists("ciudadanos_id = ".$ciudadano." and asambleas_id = $idasamblea"))){
                        $asambleac = new asambleaciudadano();
                        $asambleac->ciudadanos_id = $ciudadano;
                        $asambleac->asambleas_id = $idasamblea;
                        $asambleac->asistio = 'S';
                        $asambleac->fcaptura = date('Y-m-d H:i:s');
                        $asambleac->usuarios_id = Session::get('id');

                        if($asambleac->save()){
                            Flash::valid('<div class="alert alert-success" role="alert">
                            <strong>Exito!</strong> La asistencia ha sido registrada
                            </div>');
                        }           
                    }else{
                        Flash::valid('<div class="alert alert-warning" role="alert">
                    <strong>DUPLICADO!</strong>La asistencia ya fue guardada con anterioridad
                    </div>');
                    }
                }  
            }else{

            }
    }


    public function formlistar($id){
        view::template('templateciu');
        $ciudadano = Load::model('ciudadanos')->find($id);
        
        if ($ciudadano!=null) {
            $this->ciudadano = $ciudadano;
        }else{

        }      
    }
}

?>