<?php  


class Asambleaciudadano extends ActiveRecord
{
	protected $database = "cblanca";

	public function initilize()
	{
		$this->belongs_to('asambleas');
		$this->belongs_to('ciudadanos');
	}


	public function asistencias($idasamblea){

		$sql = "SELECT c.id, concat(c.paterno,' ',c.materno,' ',c.nombre) as nombre, u.login as capturista , tc.fcaptura as fecha FROM asambleaciudadano tc "; 
		$sql .= " INNER JOIN ciudadanos c ON c.id = tc.ciudadanos_id ";
		$sql .= " INNER JOIN usuarios u ON u.id = tc.usuarios_id ";
		$sql .= " WHERE tc.asambleas_id =". $idasamblea ." and tc.asistio = 'S'";
		$sql .= " ORDER BY nombre ASC";
		return $this->find_all_by_sql($sql);

	}
}

 ?>