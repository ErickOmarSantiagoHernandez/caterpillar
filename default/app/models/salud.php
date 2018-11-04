<?php  

class Salud extends ActiveRecord
{
	protected $database = "cblanca";

	public function initialize()
	{
		$this->belongs_to('ciudadanos');
	}

	public function listar(){
		return $this->find();
	}

}

 ?>

