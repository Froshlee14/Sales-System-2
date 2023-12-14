<?php

class Detalles_VentaData extends Extra{

    public static $tablename = "detalles_venta";
    public $extra_fields_strings;
    public $extra_fields;

    public function _construct(){
        $this->extra_fields = array();
        $this->extra_fields_strings = array();
        $this->id_venta = "";
        $this->id_producto = "";
        $this->cantidad = "";
        $this->descuento = "";
        $this->monto = "";
    }
    

    public static function getbyID($id){

        $sql = "select * from detalles_venta where id_venta=".$id;
        $query = Executor::doit($sql);

        return Model::one($query[0],new Detalles_VentaData);

    }
	
    public static function getDetallesbyventa($id_venta){

        $sql = "select * from detalles_venta where id_venta = {$id_venta}";
        $query = Executor::doit($sql);

        return Model::many($query[0],new Detalles_VentaData);

    }
	
    public function add(){

        $sql = "INSERT INTO detalles_venta (id_venta, id_producto, descuento, cantidad, monto) 
            VALUES ($this->id_venta, $this->id_producto, $this->descuento, $this->cantidad, $this->monto)";
    
		return Executor::doit($sql);
    }

    public function update(){

        $sql = "update detalles_venta set id_producto= $this->id_producto, 
                                    cantidad= $this->cantidad,
                                    descuento= $this->descuento,
                                    monto= $this->monto 
                                    where id_venta =" .$this->id_venta;
    
		return Executor::doit($sql);
    }
	
    public function delete(){

        $sql = "delete from detalles_venta where id_venta =" .$this->id_venta;
    
		return Executor::doit($sql);
    }
}

?>