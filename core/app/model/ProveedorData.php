<?php

class ProveedorData extends Extra{

    public static $tablename = "proveedor";
    public $extra_fields_strings;
    public $extra_fields;

    public function _construct(){
        $this->extra_fields = array();
        $this->extra_fields_strings = array();
        $this->id_proveedor = "";
        $this->nombre = "";
        $this->telefono = "";
        $this->sitio_web = "";
        $this->id_direccion = "";
        $this->status = "";
    }
    

    public static function getbyID($id){

        $sql = "select * from proveedor where id_proveedor=".$id;
        $query = Executor::doit($sql);

        return Model::one($query[0],new ProveedorData);

    }
	
    public static function getproveedores(){

        $sql = "select * from proveedor";
        $query = Executor::doit($sql);

        return Model::many($query[0],new ProveedorData);

    }
	
    public function add(){

        $sql = "insert into proveedor (nombre,telefono,sitio_web, id_direccion, status) 
            VALUES (\"$this->nombre\", \"$this->telefono\", \"$this->sitio_web\", $this->id_direccion, $this->status)";
    
		return Executor::doit($sql);
    }

    public function update(){

        $sql = "update proveedor set nombre=\"$this->nombre\", 
                                    telefono=\"$this->telefono\",
                                    sitio_web=\"$this->sitio_web\",
                                    id_direccion=$this->id_direccion, 
                                    status=$this->status 
                                    where id_proveedor =" .$this->id_proveedor;
    
		return Executor::doit($sql);
    }
	
    public function delete(){

        $sql = "delete from proveedor where id_proveedor =" .$this->id_proveedor;
    
		return Executor::doit($sql);
    }

    public function unsub(){

        $sql = "update proveedor set status=0 where id_proveedor =" .$this->id_proveedor;
    
		return Executor::doit($sql);
    }
}

?>