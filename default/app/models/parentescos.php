<?php  

class Parentescos extends ActiveRecord
{
	protected $database = "cblanca";



	public function listar(){
 		return $this->find("order: 2");
 	}
}

 ?>