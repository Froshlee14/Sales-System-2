<?php

class CategoriaData extends Extra{

    public static $tablename = "categoria";
    public $extra_fields_strings;
    public $extra_fields;

    public function _construct(){
        
        $this->extra_fields = array();
        $this->extra_fields_strings = array();
        $this->id_categoria = "";
        $this->nombre = "";
        $this->descripcion = "";
        #$this->status = "";

    }
    

    public static function getByID($id){

        $sql = "select * from categoria where id_categoria=".$id;
        $query = Executor::doit($sql);

        return Model::one($query[0],new CategoriaData);

    }
	
    public static function getcategorias(){

        $sql = "select * from categoria";
        $query = Executor::doit($sql);

        return Model::many($query[0],new CategoriaData);

    }
	
    public function addCat(){

		$sql = "INSERT INTO categoria (nombre, descripcion) 
                VALUES (\"$this->nombre\", $this->descripcion)";
    
		return Executor::doit($sql);
    }

    public function update(){

        $sql = "update cliente set nombre=\"$this->nombre\", 
                            descripcion=\"$this->descripcion\", 
                            where id_categoria =" .$this->id_categoria;

        return Executor::doit($sql);
    }
	
    public function borrar(){

        $sql = "delete from categoria where id_categoria =" .$this->id_categoria;
    
		return Executor::doit($sql);
    }
}

?>