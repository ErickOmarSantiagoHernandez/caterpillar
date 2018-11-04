<?php

/**
 * @author 
 * @copyright 2013
 */

class Usuarios extends ActiveRecord{

  protected $database = 'cblanca';
  
    public function initialize(){

     $this->belongs_to('subprocuradurias');
     $this->belongs_to('niveles');
     $this->belongs_to('areas');
     $this->belongs_to('cargos');
     
    }    
  
   
    public static function isValid() {
        $auth = Auth2::factory('model');
        return $auth->isValid();
    }

    public function getNombre(){
      return $this->titulo."".$this->nombre." ".$this->paterno." ".$this->materno;
    }

    
  
  public function listar(){   
    $sql = "SELECT id, CONCAT(IFNULL(nombre,''),' ',IFNULL(paterno,''),' ',IFNULL(materno,'')) AS nombre FROM usuarios WHERE activo='S' ";    
    return $this->find_all_by_sql($sql);
  }

   public function iniciarSesion() {
        //Verifico si tiene una sesión válida con una ip
        if(self::isValid()) {
            return true;
        } else {           
            //Verifico si se ha autentificado
            if(Input::hasPost('login') && Input::hasPost('clave')) {                                 
                  $usuario = Input::post('login'); //Filtro el usuario
                  $clave = Input::post('clave'); //Filtro la contraseña                  
                  $auth = Auth2::factory('model');  //Creo el objeto de Auth2 con el uso de validacion mediante modelos
                  $auth->setLogin('login'); //Defino cual es el campo del nombre de usuario
                  $auth->setPass('clave');//Defino cual es el campo del nombre de la contraseña
                  $auth->setCheckSession(true);//Se utiliza para que no inicie sesión en otro navegador (no me funciona :S)
                  $auth->setModel('usuarios'); //Indico cual es el modelo respectivo para que consulte en la base de datos
                  $auth->setAlgos('sha1');
                  $auth->setFields(array('id', 'nombre', 'paterno','materno','login','titulo', 'niveles_id','activo')); //Estos campos se almacenan en sesión automáticamente
                  return ($auth->identify($usuario,$clave) && $auth->isValid());
              }
        }
        return false;
    }
  

    

  
  

  




  public function aux_before_save(){ 
    $existe1 = $existe2 = false;
    if (!$this->id){
      $existe1 = $this->exists("login='".$this->login."'");
    }
    else{
      $existe1 = $this->exists("login='".$this->login."' AND id != ".$this->id);
    }
    if ($existe1){
      Flash::error('<div class="alert alert-danger" role="alert"><strong>Error!</strong> El nombre de usuario  '.$this->login.' ya fue registrado, verifique! </div>');
      return 'cancel'; 
    }
  }

      public function cerrarSesion() {
        //Verifico si tiene sesión
        if(!self::isValid()) {
            Flash::error("No has iniciado sesión o ha caducado. <br /> Por favor identifícate nuevamente.");
            return false;
        } else {
            $auth = Auth2::factory('model');
            $auth->logout();
            //Elimino todas las variables de sesión de la app
            unset($_SESSION['KUMBIA_SESSION'][APP_PATH]);
            return true;
        }       
    }
  



}

?>