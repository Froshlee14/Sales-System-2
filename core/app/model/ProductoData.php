<?php

class ProductoData extends Extra{

    public static $tablename = "producto";
    public $extra_fields_strings;
    public $extra_fields;

    public function _construct(){
        $this->extra_fields = array();
        $this->extra_fields_strings = array();
        $this->id_producto = "";
        $this->nombre = "";
        $this->precio = "";
        $this->stock = "";
        $this->id_proveedor = "";
        $this->id_categoria = "";
    }
    

    public static function getByID($id){

        $sql = "select * from producto where id_producto=".$id;
        $query = Executor::doit($sql);

        return Model::one($query[0],new ProductoData);

    }
	
    public static function getproducts(){

        $sql = "select * from producto";
        $query = Executor::doit($sql);

        return Model::many($query[0],new ProductoData);

    }
	
    public function addProd(){

        $sql = "INSERT INTO producto (nombre, precio, stock,id_proveedor,id_categoria) 
            VALUES (\"$this->nombre\", $this->precio, $this->stock,$this->id_proveedor,$this->id_categoria)";
    
		return Executor::doit($sql);
    }

    public function update(){

        $sql = "update producto set nombre=\"$this->nombre\", 
                                    precio= $this->precio, 
                                    stock= $this->stock,
                                    id_proveedor= $this->id_proveedor,
                                    id_categoria= $this->id_categoria 
                                    where id_producto =" .$this->id_producto;
    
		return Executor::doit($sql);
    }
	
    public function delete(){

        $sql = "delete from producto where id_producto =" .$this->id_producto;
    
		return Executor::doit($sql);
    }
    
}

?>