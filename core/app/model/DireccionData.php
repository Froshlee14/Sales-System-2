<?php

class DireccionData extends Extra{

    public static $tablename = "direccion";
    public $extra_fields_strings;
    public $extra_fields;

    public function _construct(){
        $this->extra_fields = array();
        $this->extra_fields_strings = array();
        $this->id_direccion = "";
        $this->calle = "";
        $this->numero = "";
        $this->colonia = "";
        $this->ciudad = "";
    }
    

    public static function getbyID($id){

        $sql = "select * from direccion where id_direccion=".$id;
        $query = Executor::doit($sql);

        return Model::one($query[0],new DireccionData);

    }
	
    public static function getdirecciones(){

        $sql = "select * from direccion";
        $query = Executor::doit($sql);

        return Model::many($query[0],new DireccionData);

    }
	
    public function add(){

        $sql = "INSERT INTO direccion (calle, numero, colonia,ciudad) 
            VALUES (\"$this->calle\", $this->numero, \"$this->colonia\", \"$this->ciudad\")";
    
		return Executor::doit($sql);
    }

    public function update(){

        $sql = "update direccion set calle=\"$this->calle\", 
                                    numero={$this->numero}, 
                                    colonia=\"$this->colonia\",
                                    ciudad=\"$this->ciudad\" 
                                    where id_direccion = {$this->id_direccion}";
    
		return Executor::doit($sql);
    }
	
    public function delete(){

        $sql = "delete from direccion where id_direccion =" .$this->id_direccion;
    
		return Executor::doit($sql);
    }

}

?>