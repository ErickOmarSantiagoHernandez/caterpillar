<?php 

if (!Session::has('id')) {
    Flash::valid('<div class="alert alert-warning" role="alert">
        <strong>Algo salio mal! </strong> La session expiró, vuelva a iniciar sesion
    </div>');   
    Redirect::to("principal/login");        
    exit();
}

load::model('ciudadanos');

class CiudadanosController extends AppController { 

     public $limit_params = FALSE;

	public function formcreacion($id){
        View::template('templateciu');   

        if ($id=='4ZY2') {
            $ciudadano = new Ciudadanos();
            $ciudadano->activo ='N';
            $ciudadano->save();
            $this->ciudadano= $ciudadano;
        }else{
            $ciudadano = Load::model('ciudadanos')->find($id);
            if ($ciudadano) {
                $this->ciudadano = $ciudadano;
            }
        }     
        if(Input::haspost('ciudadano')){	
        	if (Input::haspost('idciudadano')) {
                $ide = Input::post('idciudadano');
        		$ciudadano = Load::model('ciudadanos')->find($ide);
        			
        		$datos = Input::post('ciudadano');  		
        		$ciudadano->nombre  = mb_strtoupper($datos['nombre'],'utf-8');
        		$ciudadano->materno = mb_strtoupper($datos['materno'],'utf-8');
        		$ciudadano->paterno = mb_strtoupper($datos['paterno'],'utf-8');
        		$ciudadano->lugarnacimiento= mb_strtoupper($datos['lugarnacimiento'],'utf-8');
        		$ciudadano->fechanacimiento=date_format(date_create($datos['fechanacimiento']),'Y-m-d');
        		$ciudadano->calledomicilio=mb_strtoupper($datos['calledomicilio'],'utf-8');
        		$ciudadano->numerodomicilio=$datos['numerodomicilio'];
        		$ciudadano->residencia=mb_strtoupper($datos['residencia'],'utf-8');
        		$ciudadano->sexo=$datos['sexo'];
        		$ciudadano->dialectos_id=$datos['lenguamaterna'];
        		$ciudadano->ocupacion=mb_strtoupper($datos['ocupacion'],'utf-8');
        		$ciudadano->escolaridades_id=$datos['escolaridad'];
        		$ciudadano->edociviles_id=$datos['edocivil'];
        		$ciudadano->fechacasado=($datos['fechacasado']!='') ? date_format(date_create($datos['fechacasado']),'Y-m-d'):'';
        		$ciudadano->fechaciudadano=($datos['fechaciudadano']!='') ? date_format(date_create($datos['fechaciudadano']),'Y-m-d'):'';
        		$ciudadano->fechapredio=($datos['fechapredio']!='') ? date_format(date_create($datos['fechapredio']),'Y-m-d'):'';
        		$ciudadano->servicioagua=$datos['servicioagua'];
        		$ciudadano->nombretomaagua=mb_strtoupper($datos['nombretomaagua'],'utf-8');
        		$ciudadano->salud_id=$datos['serviciosalud'];
        		$ciudadano->serviciopanteon=$datos['serviciopanteon'];
        		$ciudadano->nombreresponsable=mb_strtoupper($datos['nombreresponsable'],'utf-8');
        		$ciudadano->serviciodrenaje=$datos['serviciodrenaje'];
        		$ciudadano->servicioenergia=$datos['servicioenergia'];
                $ciudadano->usuarios_id=$datos['usuario'];

                if(($ciudadano->fechacasado!='')||($ciudadano->fechaciudadano!='')||($ciudadano->fechapredio!='')){
                    $ciudadano->activo='S';
        			if($ciudadano->update()){
    					Flash::valid('<div class="alert alert-success" role="alert"><strong>Exito!</strong> Los datos del ciudadano han sido actualizados</div>');
    	    			Redirect::to('ciudadanos/formcreacion/'.$ciudadano->id);
    	    			$this->ciudadano = $ciudadano;
        			}
                }else{
                    Flash::valid('<div class="alert alert-danger" role="alert"><strong>Error!</strong> Los datos del ciudadano no han sido registrados, debe guardar una de las tres fechas en la que toma ciudadania para finalizar correctamente</div>');
                        Redirect::to('ciudadanos/formcreacion/'.$ciudadano->id);
                        $this->ciudadano = $ciudadano;
                }    		     
        	}else{
                Flash::error('<div class="alert alert-danger" role="alert"><strong>NO REALLIZO LA ACCIÓN!</strong>Ah ocurrido un error</div>');
                Redirect::to('principal/nodisponible/');
            }
        }
	}

    public function formbusqueda(){
        View::template('templatebusqueda');

    }

    public function formvista($id){
        view::template('templateciu');

        $ciudadano = Load::model('ciudadanos')->find($id);

        if ($ciudadano) {
            $this->ciudadano = $ciudadano;
        }
    }


}

 ?>