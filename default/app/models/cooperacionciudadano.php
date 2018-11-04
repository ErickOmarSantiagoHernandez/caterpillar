<?php  

/**
*  
*/
class Cooperacionciudadano extends ActiveRecord
{
	protected $database='cblanca';
	
	public function initilize()
	{
		$this->belongs_to('ciudadanos');
		$this->belongs_to('cooperaciones');
		
	}

	public function asistencias($idcooperacion){

		$sql = "SELECT c.id, concat(c.paterno,' ',c.materno,' ',c.nombre) as nombre, u.login as capturista , tc.fcaptura as fecha FROM cooperacionciudadano tc "; 
		$sql .= " INNER JOIN ciudadanos c ON c.id = tc.ciudadanos_id ";
		$sql .= " INNER JOIN usuarios u ON u.id = tc.usuarios_id ";
		$sql .= " WHERE tc.cooperaciones_id =". $idcooperacion ." and tc.asistio = 'S'";
		$sql .= " ORDER BY nombre ASC";
		return $this->find_all_by_sql($sql);

	}
}

 ?>