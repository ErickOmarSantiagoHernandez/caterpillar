<?php

if (!Session::has('id')) {
	Flash::valid('<div class="alert alert-warning" role="alert">
		<strong>Algo salio mal! </strong> La session expiró, vuelva a iniciar sesion
	</div>');	
	Redirect::to("principal/login");		
	exit();

}
Load::models('usuarios');

 class UsuariosController extends AppController
{


  public function crear(){ // metodo para crear al usuario (actualizado)
	View::template('templatemenus');
	$this->usuarios=Load::model('usuarios')->find();
	
	
	    if(Input::hasPost('usuarios')){
			$datos=Input::post('usuarios');
			$usuario= new Usuarios();

			$usuario->login=Input::post('login');
			$usuario->clave=sha1($datos['pw']);
			$usuario->repite=sha1($datos['repite']);
			$usuario->titulo=mb_strtoupper($datos['level'],'utf-8');
			$usuario->nombre=mb_strtoupper($datos['name'],'utf-8');
			$usuario->paterno=mb_strtoupper($datos['apepat'],'utf-8');
			$usuario->materno=mb_strtoupper($datos['apemat'],'utf-8');
			$usuario->activo=$datos['activo'];
			$usuario->niveles_id=1;

		    if(!$usuario->save()){ 
				Flash::error('<div class="alert alert-danger" role="alert">
	  					<strong>Error!</strong> El usuario no pudo ser creado
						</div>'); 
			}else{ 
				Flash::valid('<div class="alert alert-success" role="alert">
	  					<strong>Exito!</strong> Usuario agregado Correctamente
						</div>');					
				Input::delete();

			}
	    }
  }	



	public function resetear($id=null){ // funcion para resetear la contraseña de un usuario 
		View::template('templatemenus');
		$idusu=$id;
		$usuario=Load::model('usuarios')->find($idusu);
		$usuario->clave =sha1('clave123'); 
		$usuario->repite = sha1('clave123');
		if ($usuario->update()){
			Flash::valid('<div class="alert alert-success" role="alert">
  					<strong>Exito!</strong> Password reseteado  Correctamente
					</div>');					
		
		}
		else{				
			Flash::error('Falló Operación'); 
		}
		Redirect::toAction("crear");
	}

  }
	
   
   


