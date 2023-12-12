<?php

	if(!isset($_SESSION["user_id"])){
		Core::redir("./");
	}
	
	if(isset($_GET["opt"]) && $_GET["opt"] == "add"){
		//deben coincidir con los atribitos name de la etiqueta del formulario
		var_dump($_POST);
		if(isset($_POST["id_cliente"]) && $_POST["nuevo_numero"]){
			//var_dump($_POST)

            $tel = new NumeroTelefonicoData();
            $tel->numero = $_POST["nuevo_numero"];
            $tel->id_cliente = intval($_POST["id_cliente"]);
            $tel->add();

			echo "agregado";
			//Core::addToastr('success','Usuario agregado on exito');
			Core::redir("./?view=clientes&opt=edit&id=". $_POST["id_cliente"]);
			
		}
		else{
			echo "No";
		}
	}
	
	if(isset($_GET["opt"]) && $_GET["opt"] == "update"){
		//deben coincidir con los atribitos name de la etiqueta del formulario
			//var_dump($_POST)
			$c = ClienteData::getbyID($_POST["id_cliente"]);
			
			$c->nombre = $_POST["nombre"];
			$c->id_direccion = $_POST["id_direccion"];
			
			$c-> update();
			
			echo "actualizado";
			//Core::addToastr('success','Usuario agregado on exito');
			Core::redir("./?view=clientes&opt=all");

	}

	if(isset($_GET["opt"]) && $_GET["opt"] == "delete"){

			$tel = NumeroTelefonicoData::getbyID($_GET["id"]);
			$tel->delete();
		
			
			echo "registro eliminado";
			//Core::addToastr('success','Usuario eliminado con exito');
            Core::redir("./?view=clientes&opt=edit&id=". $_GET["id_cliente"]);
			//Core::redir("./?view=clientes&opt=all");

	}

?>