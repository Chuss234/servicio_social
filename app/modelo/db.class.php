<?php
class BaseDeDatos {
    protected $conexion;
    protected $isConnected = false;
    public function conectar() {
        $this->conexion = new mysqli("localhost", "root", "catolica", "serviciosocial");
        if ($this->conexion->connect_errno) {
            echo "Error de conexion " . $this->conexion->connect_error;
            $this->isConnected = false;
        } else {
            $this->isConnected = true;
        }
        return $this->isConnected;
    }
    public function consultar($sql) {
        $result = $this->conexion->query($sql);
        if ($this->conexion->errno) {
            echo "Error mysql:" . $this->conexion->error;
        }
        return $result;
    }
    public function numero_filas($result) {
        return $result->num_rows;
    }

    public function cerrar() {
        $this->conexion->close();
    }
}
?>