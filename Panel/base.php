<?php
//if(strpos($_SERVER['HTTP_REFERER'],"http://www.mofuss.unam.mx/")!=0 || $_SERVER['HTTP_REFERER']=="" )
//if(strpos($_SERVER['HTTP_REFERER'],"https://www.mofuss.unam.mx/")!=0 || $_SERVER['HTTP_REFERER']=="" )
//if(strpos($_SERVER['HTTP_REFERER'],"http://www.wegp.unam.mx/")!=0 || $_SERVER['HTTP_REFERER']=="" )
//if(strpos($_SERVER['HTTP_REFERER'],"https://www.wegp.unam.mx/")!=0 || $_SERVER['HTTP_REFERER']=="" )
//header("Location: http://www.wegp.unam.mx",true, 301);
//echo $_SERVER['HTTP_REFERER'];


class Base{
	public $db;
	public $name="mofuss";
	public $usr="root";
	public $servidor="localhost";
	public function __construct($a,$b,$c)
  {
  $this->servidor=$a;
  $this->usr=$b;  
       if($c=='global') $c="conabio";
  $this->name=$c;
	$this->db = new mysqli($a, $b, "dbPASWD", $c);
     if ($this->db->connect_error)
        die('Error de Conexion ('.$this->db->connect_errno.')'.$this->db->connect_error);
  }
  public function setBase($nombre){
       if($nombre=='global') $nombre="conabio";
  	$this->db = new mysqli($this->servidor, $this->usr, "dbPASWD", $nombre);
     if ($this->db->connect_error)
        die('Error de Conexion ('.$this->db->connect_errno.')'.$this->db->connect_error);	
  }
  /*  public function setBase($usuario, $nombre){
  	$this->db = new mysqli($servidor, $usuario, "dbPASWD", $nombre);
     if ($this->db->connect_error)
        die('Error de Conexion ('.$this->db->connect_errno.')'.$this->db->connect_error);	
  }
    public function setBase($serv, $usuario,$nombre){
  	$this->db = new mysqli($serv, $usuario, "dbPASWD", $nombre);
     if ($this->db->connect_error)
        die('Error de Conexion ('.$this->db->connect_errno.')'.$this->db->connect_error);	
  }*/
  	public function consulta($query){
    	return $this->db->query($query);
  	}
  
}
?>
