<?php
include_once(__dir__."/db.class.php");
class GetDatos extends BaseDeDatos {
	public function consultaGen($query){
		$datos=array();
		if (!$this->isConnected) {
			$this->conectar();
		}
		$consulta=$this->consultar($query);
		if ($this->numero_filas($consulta)) {
			while ($row=$consulta->fetch_assoc()){
				$datos[]=$row;
			}
		}
		return $datos;
	}

	public function getLastInsert() {
		return $this->conexion->insert_id;
	}

	public function insertar($query) {
		if (!$this->isConnected) {
			$this->conectar();
		}
		$consulta=$this->consultar($query);
		return $this->getLastInsert();
	}

	public function actualizar($query) {
		if (!$this->isConnected) {
			$this->conectar();
		}
		$consulta=$this->consultar($query);
		return true;
	}

	public function borrar($query) {
		if (!$this->isConnected) {
			$this->conectar();
		}
		$consulta=$this->consultar($query);
		return true;
	}
}





?>