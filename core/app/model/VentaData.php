<?php

class VentaData extends Extra{

    public static $tablename = "venta";
    public $extra_fields_strings;
    public $extra_fields;

    public function _construct(){
        $this->extra_fields = array();
        $this->extra_fields_strings = array();
        $this->id_venta = "";
        $this->fecha = "";
        $this->id_cliente = "";
        $this->monto = "";
    }
    

    public static function getbyID($id){

        $sql = "select * from venta where id_venta=".$id;
        $query = Executor::doit($sql);

        return Model::one($query[0],new VentaData);

    }
	
    public static function getVenta(){

        $sql = "select * from venta order by fecha DESC";
        $query = Executor::doit($sql);

        return Model::many($query[0],new VentaData);

    }
	
    public function addvent(){

        $sql = "INSERT INTO venta (fecha, id_cliente,monto) 
            VALUES (\"$this->fecha\", $this->id_cliente, $this->monto)";
    
		return Executor::doit($sql);
    }

    public function update(){

        $sql = "update venta set fecha=\"$this->fecha\", 
                                    id_cliente=$this->id_cliente,
                                    monto= $this->monto
                                    where id_venta =" .$this->id_venta;
    
		return Executor::doit($sql);
    }
	
    public function delete(){

        $sql = "delete from venta where id_venta =" .$this->id_venta;
    
		return Executor::doit($sql);
    }
}

?>