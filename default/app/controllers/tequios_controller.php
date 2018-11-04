<?php 


if (!Session::has('id')) {
    Flash::valid('<div class="alert alert-warning" role="alert">
        <strong>Algo salio mal! </strong> La session expiró, vuelva a iniciar sesion
    </div>');   
    Redirect::to("principal/login");        
    exit();
}
Load::models('Tequios','tequiociudadano');
class TequiosController extends AppController { 

     public $limit_params = FALSE;

     public function formcreacion($id){
     	view::template('templatebusqueda');

        if ($id=='4ZY2') {
            $tequios = new Tequios();
            $tequios->activo ='N';
            $tequios->save();
            $this->tequio = $tequios;
        }else{
            $tequios = Load::model('tequios')->find($id);
            if ($tequios) {
                $this->tequio = $tequios;
            }
        }     
     	if (Input::hasPost('tequio')) {
     		$datos = Input::post('tequio');	
     		$tequio = Load::model('tequios')->find($tequios->id);

     		$tequio->tipo = mb_strtoupper($datos['tipo'],'utf8');
     		$tequio->descripcion = mb_strtoupper($datos['descripcion'],'utf8');
     		$tequio->organiza = mb_strtoupper($datos['organiza'],'utf8');
    		$tequio->fechatequio=($datos['fecha']!='') ? date_format(date_create($datos['fecha']),'Y-m-d'):'';
            $tequio->activo = 'S';
            $tequio->fechacreacion=date('Y-m-d');
     		if ($tequio->update()) {
     			Flash::valid('<div class="alert alert-success" role="alert"><strong>Exito!</strong> Los datos del tequio han sido registrado correctatemente</div>');
    	    	Redirect::to('tequios/formcreacion/'.$tequio->id);
     		}else{
     			Flash::valid('<div class="alert alert-red" role="alert"><strong>Error!</strong> Los datos del tequio no han sido registrados</div>');
    	    	Redirect::to('principal/nodisponible');
     		}
     	}

     }

    public function desactivar($id){
        view::select(null);
        view::template(null);

        $tequio = Load::model('tequios')->find($id);
        if ($tequio) {
            $tequio->activo='N';
            if ($tequio->update()) {
                Flash::valid('<div class="alert alert-success" role="alert"><strong>Exito!</strong> El tequio ha sido desactivado correctatemente</div>');
                Redirect::to('tequios/formbusqueda/');
            }else{
                Flash::valid('<div class="alert alert-red" role="alert"><strong>Error!</strong> El tequio no fue sido desactivado</div>');
                Redirect::to('tequios/formbusqueda/');
            }
        }
    }

    public function activar($id){
        view::select(null);
        view::template(null);

        $tequio = Load::model('tequios')->find($id);
        if ($tequio) {
            $tequio->activo='S';
            if ($tequio->update()) {
                Flash::valid('<div class="alert alert-success" role="alert"><strong>Exito!</strong> El tequio ha sido activado correctatemente</div>');
                Redirect::to('tequios/formbusqueda/');
            }else{
                Flash::valid('<div class="alert alert-red" role="alert"><strong>Error!</strong> El tequio no fue sido activado</div>');
                Redirect::to('tequios/formbusqueda/');
            }
        }
    }    


    public function formbusqueda(){
        View::template('templatebusqueda');

    }

    public function formlista($id){
        View::template('templatebusqueda');

        $tequio = Load::model('tequios')->find($id);
        if ($tequio){
            $this->tequio = $tequio;
        }
            if ((Input::hasPost('listasistencia'))&&(Input::hasPost('idtequio'))) {
                $ciudadanos=Input::post('listasistencia');
                $idtequio=Input::post('idtequio');
                foreach($ciudadanos as $ciudadano){
                    if (!(Load::model('tequiociudadano')->exists("ciudadanos_id = ".$ciudadano." and tequios_id = $idtequio"))){
                        $tequioc = new Tequiociudadano();
                        $tequioc->ciudadanos_id = $ciudadano;
                        $tequioc->tequios_id = $idtequio;
                        $tequioc->asistio = 'S';
                        $tequioc->fcaptura = date('Y-m-d H:i:s');
                        $tequioc->usuarios_id = Session::get('id');                        
                        if($tequioc->save()){
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