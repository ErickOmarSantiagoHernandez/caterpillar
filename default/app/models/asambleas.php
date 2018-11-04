<?php  


class asambleas extends ActiveRecord
{
	protected $database= "cblanca";

	public function initilize()
	{
		$this->has_many('asambleaciudadano');
	}

	public function listar($fca,$fpr,$fci){

		//Las tres fechas fueron recibidas
		if ($fca!=null) {
			if ($fpr!=null) {
				if ($fci!=null) {
					$case = 1;
				}
			}
		}
		//Solo recibio fecha casado
		if ($fca!=null) {
			if ($fpr==null) {
				if ($fci==null) {
					$case = 2;
				}
			}
		}	
		//Solo recibio la fecha predio
		if ($fca==null) {
			if ($fpr!=null) {
				if ($fci==null) {
					$case = 3;
				}
			}
		}	
		//solo recibio la fecha ciudadano
		if ($fca==null) {
			if ($fpr==null) {
				if ($fci!=null) {
					$case = 4;
				}
			}
		}		
		//Recibio la fecha casado y predio
		if ($fca!=null) {
			if ($fpr!=null) {
				if ($fci==null) {
					$case = 5;
				}
			}
		}		
		//Recibio la fecha del predio y la de ciudadano
		if ($fca==null) {
			if ($fpr!=null) {
				if ($fci!=null) {
					$case = 6;
				}
			}
		}		
		//Recibio la fecha de casado y la de ciudadano
		if ($fca!=null) {
			if ($fpr==null) {
				if ($fci!=null) {
					$case = 7;
				}
			}
		}	
		//No recibio ni una fecha

		switch ($case){
			case 1: $sql = "SELECT * FROM asambleas WHERE (fechaasamblea > '".$fca."' OR fechaasamblea > '".$fpr."' OR fechaasamblea > '".$fci."') and activo = 'S'"; break;
			case 2: $sql = "SELECT * FROM asambleas WHERE (fechaasamblea > '".$fca."') and activo = 'S'"; break;
			case 3: $sql = "SELECT * FROM asambleas WHERE (fechaasamblea > '".$fpr."') and activo = 'S'"; break;
			case 4: $sql = "SELECT * FROM asambleas WHERE (fechaasamblea > '".$fci."') and activo = 'S'"; break;
			case 5: $sql = "SELECT * FROM asambleas WHERE (fechaasamblea > '".$fca."' OR fechaasamblea > '".$fpr."') and activo = 'S'"; break;
			case 6: $sql = "SELECT * FROM asambleas WHERE (fechaasamblea > '".$fpr."' OR fechaasamblea > '".$fci."') and activo = 'S'"; break;							
			case 7: $sql = "SELECT * FROM asambleas WHERE (fechaasamblea > '".$fca."' OR fechaasamblea > '".$fci."') and activo = 'S'"; break;
		}
		return $this->find_all_by_sql($sql);
	}
}

 ?>