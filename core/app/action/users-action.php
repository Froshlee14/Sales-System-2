<?php

	if(!isset($_SESSION["user_id"])){
		Core::redir("./");
	}
	
	if(isset($_GET["opt"]) && $_GET["opt"] == "add"){
		//deben coincidir con los atribitos name de la etiqueta del formulario
		var_dump($_POST);
			//var_dump($_POST)
			$u = new UserData();
			$u->nombre = $_POST["nombre"];
			$u->username = $_POST["username"];
			$u->password = sha1(md5($_POST["password"]));
			$u->status = 1;
			
			$arr = $u->add();
			echo "agregado";
            foreach ($arr as $key => $item){ 
                echo $item,",";
            }
			Core::addToastr('success','Usuario agregado con exito');
			Core::redir("./?view=users&opt=all");
		
	}
	
	if(isset($_GET["opt"]) && $_GET["opt"] == "update"){
		//deben coincidir con los atribitos name de la etiqueta del formulario
			//var_dump($_POST)
			$u = UserData::getByID($_POST["user_id"]);
			
			$u->nombre = $_POST["nombre"];
			$u->username = $_POST["username"];
			//$u->password = $_POST["password"];
			//$u->kind = 1;
			//$u->status = 1;
			
			$u-> update();
			
			/* 
			if(isset($_POST["password"]) and $_POST["password"]!=""){
				$u->password = sha1(md5($_POST["password"]));
				$u->updatePass();
				
			} 
			*/

			Core::addToastr('success','Usuario actualizado con exito');
			Core::redir("./?view=users&opt=all");

	}

	if(isset($_GET["opt"]) && $_GET["opt"] == "delete"){

			$u = UserData::getByID($_GET["id"]);
			$u->delete();
			//$u->darBaja();
		
			Core::addToastr('success','Usuario eliminado con exito');
			Core::redir("./?view=users&opt=all");

	}

?>