<?php

class ClienteData extends Extra{

    public static $tablename = "cliente";
    public $extra_fields_strings;
    public $extra_fields;

    public function _construct(){
        $this->extra_fields = array();
        $this->extra_fields_strings = array();
        $this->id_cliente = "";
        $this->nombre = "";
        $this->id_direccion = "";
        $this->status = "";
    }
    

    public static function getbyID($id){

        $sql = "select * from cliente where id_cliente=".$id;
        $query = Executor::doit($sql);

        return Model::one($query[0],new ClienteData);

    }
	
    public static function getclientes(){

        $sql = "select * from cliente";
        $query = Executor::doit($sql);

        return Model::many($query[0],new ClienteData);

    }
	
    public function add(){

        $sql = "INSERT INTO cliente (nombre, id_direccion, status) 
            VALUES (\"$this->nombre\", $this->id_direccion, $this->status)";
    
		return Executor::doit($sql);
    }

    public function update(){

        $sql = "update cliente set nombre=\"$this->nombre\", 
                                    status=\"$this->status\" 
                                    where id_cliente =" .$this->id_cliente;
    
		return Executor::doit($sql);
    }
	
    public function delete(){

        $sql = "delete from cliente where id_cliente =" .$this->id_cliente;
    
		return Executor::doit($sql);
    }

    public function unsub(){

        $sql = "update cliente set status=0 where id_cliente =" .$this->id_cliente;
    
		return Executor::doit($sql);
    }
}

?>