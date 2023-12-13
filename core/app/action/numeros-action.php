<?php

	if(!isset($_SESSION["user_id"])){
		Core::redir("./");
	}
	
	if(isset($_GET["opt"]) && $_GET["opt"] == "add"){
		//deben coincidir con los atribitos name de la etiqueta del formulario
		var_dump($_POST);
			//var_dump($_POST)

            $tel = new NumeroTelefonicoData();
            $tel->numero = $_POST["nuevo_numero"];
            $tel->id_cliente = intval($_POST["id_cliente"]);
            $tel->add();

			Core::addToastr('success','Numero agregado con exito');
			Core::redir("./?view=clientes&opt=edit&id=". $_POST["id_cliente"]);
			
	}
	
	if(isset($_GET["opt"]) && $_GET["opt"] == "update"){
		//deben coincidir con los atribitos name de la etiqueta del formulario
			//var_dump($_POST)
			$c = ClienteData::getbyID($_POST["id_cliente"]);
			
			$c->nombre = $_POST["nombre"];
			$c->id_direccion = $_POST["id_direccion"];
			
			$c-> update();
			
			Core::addToastr('success','Numero actualizado con exito');
			Core::redir("./?view=clientes&opt=all");

	}

	if(isset($_GET["opt"]) && $_GET["opt"] == "delete"){

			$tel = NumeroTelefonicoData::getbyID($_GET["id"]);
			$tel->delete();
		
			Core::addToastr('success','Numero eliminado con exito');
            Core::redir("./?view=clientes&opt=edit&id=". $_GET["id_cliente"]);

	}

?>