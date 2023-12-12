<?php

class NumeroTelefonicoData extends Extra{

    public static $tablename = "numero_telefonico";
    public $extra_fields_strings;
    public $extra_fields;

    public function _construct(){
        $this->extra_fields = array();
        $this->extra_fields_strings = array();
        $this->id_numero = "";
        $this->id_cliente = "";
        $this->numero = "";
    }
    

    public static function getbyID($id){

        $sql = "select * from numero_telefonico where id_numero=".$id;
        $query = Executor::doit($sql);

        return Model::one($query[0],new NumeroTelefonicoData);

    }

    public static function getbycliente($id){

        $sql = "select * from numero_telefonico where id_cliente=".$id;
        $query = Executor::doit($sql);

        return Model::many($query[0],new NumeroTelefonicoData);

    }
	
    public static function getclientes(){

        $sql = "select * from numero_telefonico";
        $query = Executor::doit($sql);

        return Model::many($query[0],new NumeroTelefonicoData);

    }
	
    public function add(){

        $sql = "INSERT INTO numero_telefonico (id_cliente, numero) 
            VALUES ($this->id_cliente, \"$this->numero\")";
    
		return Executor::doit($sql);
    }

    public function update(){

        $sql = "update numero_telefonico set id_cliente=$this->id_cliente, 
                                    numero=\"$this->numero\",
                                    where id_numero =" .$this->id_numero;
    
		return Executor::doit($sql);
    }
	
    public function delete(){

        $sql = "delete from numero_telefonico where id_numero =" .$this->id_numero;
    
		return Executor::doit($sql);
    }

}

?>