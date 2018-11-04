<?php

/**
 * @author 
 * @copyright 2013
 */
class Escolaridades extends ActiveRecord{
    protected $database = 'cblanca';

	public function initialize(){
		$this->has_many('familiares');
    }    
	
	public function listar(){
		return $this->find();
	}
}

?>