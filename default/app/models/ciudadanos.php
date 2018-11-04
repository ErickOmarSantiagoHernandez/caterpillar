<?php 


class Ciudadanos extends ActiveRecord
{
	protected $database = 'cblanca';	

  public function initialize(){
    $this->has_many('familiares');
    $this->has_many('asambleaciudadano');
    $this->has_many('cooperacionciudadano');
    $this->has_many('tequiociudadano');
    $this->belongs_to('edociviles');
    $this->belongs_to('salud');
    $this->belongs_to('dialectos');
    $this->belongs_to('escolaridades');

  }  

  	public function getNombre(){
		return $this->nombre.' '.$this->paterno.' '.$this->materno;
	}


  public function getClasifica($idt){

    $sql = "SELECT * FROM ciudadanos ";
    $sql .= " WHERE (fechaciudadano < '".$idt."' or fechacasado < '".$idt."' or fechapredio < '".$idt."') and activo = 'S' ORDER BY paterno ASC"; 
        return $this->find_all_by_sql($sql);

  }


}

 ?>


