<?php  

class Familiares extends ActiveRecord
{
	protected $database = "cblanca";

	public function initialize()
	{
		$this->belongs_to('ciudadanos');
		$this->belongs_to('parentescos');
		$this->belongs_to('edociviles');
	}

	public function getNombre(){
		return $this->nombre.' '.$this->paterno.' '.$this->materno;
	}
}

 ?>




