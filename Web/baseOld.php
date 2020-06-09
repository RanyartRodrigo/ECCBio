<?php
class Base{
	public $db;
	public $name="mofuss";
	public $usr="root";
	public $servidor="localhost";
	public function __construct($a,$b,$c)
  {
  $this->servidor=$a;
  $this->usr=$b;
  $this->name=$c;  
	$this->db = new mysqli($a, $b, "dbPASWD", $c);
     if ($this->db->connect_error)
        die('Error de Conexion ('.$this->db->connect_errno.')'.$this->db->connect_error);
  }
  public function setBase($nombre){
  	$this->db = new mysqli($this->servidor, $this->usr, "dbPASWD", $nombre);
     if ($this->db->connect_error)
        die('Error de Conexion ('.$this->db->connect_errno.')'.$this->db->connect_error);	
  }
  	public function consulta($query){
    	return $this->db->query($query);
  	}
}
?>
