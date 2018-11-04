<?php 

if (!Session::has('id')) {
    Flash::valid('<div class="alert alert-warning" role="alert">
        <strong>Algo salio mal! </strong> La session expiró, vuelva a iniciar sesion
    </div>');   
    Redirect::to("principal/login");    
    exit();    
}

Load::models('cooperaciones','cooperacionciudadano');
class CooperacionesController extends AppController { 

     public $limit_params = FALSE;

     public function formcreacion($id){
     	view::template('templatebusqueda');

        if ($id=='4ZY2') {
            $cooperacion = new cooperaciones();
            $cooperacion->activo ='N';
            $cooperacion->save();
            $this->cooperacion = $cooperacion;
        }else{
            $cooperacion = Load::model('cooperaciones')->find($id);
            if ($cooperacion) {
                $this->cooperacion = $cooperacion;
            }
        }     
     	if (Input::hasPost('cooperacion')) {
     		$datos = Input::post('cooperacion');	
     		$cooperacion = Load::model('cooperaciones')->find($cooperacion->id);

     		$cooperacion->tipo = mb_strtoupper($datos['tipo'],'utf8');
     		$cooperacion->descripcion = mb_strtoupper($datos['descripcion'],'utf8');
     		$cooperacion->organiza = mb_strtoupper($datos['organiza'],'utf8');
    		$cooperacion->fechacooperacion=($datos['fecha']!='') ? date_format(date_create($datos['fecha']),'Y-m-d'):'';
            $cooperacion->activo = 'S';
            $cooperacion->cantidad = $datos['cantidad'];
            $cooperacion->fechacreacion=date('Y-m-d H:i:s');
     		if ($cooperacion->update()) {
     			Flash::valid('<div class="alert alert-success" role="alert"><strong>Exito!</strong> Los datos del cooperacion han sido registrado correctatemente</div>');
    	    	Redirect::to('cooperaciones/formcreacion/'.$cooperacion->id);
     		}else{
     			Flash::valid('<div class="alert alert-red" role="alert"><strong>Error!</strong> Los datos del cooperacion no han sido registrados</div>');
    	    	Redirect::to('principal/nodisponible');
     		}
     	}

     }

    public function desactivar($id){
        view::select(null);
        view::template(null);

        $cooperacion = Load::model('cooperaciones')->find($id);
        if ($cooperacion) {
            $cooperacion->activo='N';
            if ($cooperacion->update()) {
                Flash::valid('<div class="alert alert-success" role="alert"><strong>Exito!</strong> La cooperacion ha sido desactivada correctatemente</div>');
                Redirect::to('cooperaciones/formbusqueda/');
            }else{
                Flash::valid('<div class="alert alert-red" role="alert"><strong>Error!</strong> La cooperacion no fue sido desactivada</div>');
                Redirect::to('cooperaciones/formbusqueda/');
            }
        }
    }

    public function activar($id){
        view::select(null);
        view::template(null);

        $cooperacion = Load::model('cooperaciones')->find($id);
        if ($cooperacion) {
            $cooperacion->activo='S';
            if ($cooperacion->update()) {
                Flash::valid('<div class="alert alert-success" role="alert"><strong>Exito!</strong> La cooperacion ha sido activada correctatemente</div>');
                Redirect::to('cooperaciones/formbusqueda/');
            }else{
                Flash::valid('<div class="alert alert-red" role="alert"><strong>Error!</strong> La cooperacion no fue sido activada</div>');
                Redirect::to('cooperaciones/formbusqueda/');
            }
        }
    }

    public function formbusqueda(){
        View::template('templatebusqueda');

    }

    public function formlista($id){
        View::template('templatebusqueda');

        $cooperacion = Load::model('cooperaciones')->find($id);
        if ($cooperacion){
            $this->cooperacion = $cooperacion;
        }
            if ((Input::hasPost('listasistencia'))&&(Input::hasPost('idcooperacion'))) {
                $ciudadanos=Input::post('listasistencia');
                $idcooperacion=Input::post('idcooperacion');
                foreach($ciudadanos as $ciudadano){
                    if (!(Load::model('cooperacionciudadano')->exists("ciudadanos_id = ".$ciudadano." and cooperaciones_id = $idcooperacion"))){
                        $coopera = new cooperacionciudadano();
                        $coopera->ciudadanos_id = $ciudadano;
                        $coopera->cooperaciones_id = $idcooperacion;
                        $coopera->asistio = 'S';
                        $coopera->fcaptura = date('Y-m-d H:i:s');
                        $coopera->usuarios_id = Session::get('id');

                        if($coopera->save()){
                            Flash::valid('<div class="alert alert-success" role="alert">
                            <strong>Exito!</strong> La cooperacion ha sido registrada
                            </div>');
                        }           
                    }else{
                        Flash::valid('<div class="alert alert-warning" role="alert">
                    <strong>DUPLICADO!</strong>La cooperacion ya fue guardada con anterioridad
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