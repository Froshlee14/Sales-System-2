<?php

class UserData extends Extra{

    public static $tablename = "user";
    public $extra_fields_strings;
    public $extra_fields;

    public function _construct(){
        $this->extra_fields = array();
        $this->extra_fields_strings = array();
        $this->nombre = "";
        $this->username = "";
        $this->password = "";
        $this->status = "";
    }
    

    public static function getByID($id){

        $sql = "select * from user where id=".$id;
        $query = Executor::doit($sql);

        return Model::one($query[0],new UserData);

    }
	
    public static function getUsers(){

        $sql = "select * from user";
        $query = Executor::doit($sql);

        return Model::many($query[0],new UserData);

    }
	
    public function add(){

        //$sql = "insert into user (nombre,apellido,username,password,email,kind,status) 
		//		value (".$this->nombre.",".$this->apellido.",".$this->username.",".$this->password.",".$this->email.",".$this->kind.",".$this->status.")";
		$sql = "INSERT INTO user (nombre, username, password, status) 
            VALUES (\"$this->nombre\", \"$this->username\", \"$this->password\", $this->status)";
    
		return Executor::doit($sql);
    }

    public function update(){

        $sql = "update user set nombre=\"$this->nombre\", username=\"$this->username\" where id =" .$this->id;
    
		return Executor::doit($sql);
    }
	
    public function delete(){

        $sql = "delete from user where id =" .$this->id;
    
		return Executor::doit($sql);
    }

    public function unsub(){

        $sql = "update user set status=0 where id =" .$this->id;
    
		return Executor::doit($sql);
    }
}

?>