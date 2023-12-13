<?php

	if(!isset($_SESSION["user_id"])){
		Core::redir("./");
	}
	
	if(isset($_GET["opt"]) && $_GET["opt"] == "add"){
		//deben coincidir con los atribitos name de la etiqueta del formulario
		var_dump($_POST);
			//var_dump($_POST)

            $dir = new DireccionData();
            $dir->calle = $_POST["calle"];
            $dir->numero = intval($_POST["numero"]);
            $dir->colonia = $_POST["colonia"];
            $dir->ciudad = $_POST["ciudad"];
            $respuesta = $dir-> add();

			$c = new ClienteData();
			$c->nombre = $_POST["nombre"];
			$c->id_direccion = $respuesta[1];
			$c->status = 1;
			
			$cliente = $c->add();

            $tel = new NumeroTelefonicoData();
            $tel->numero = $_POST["numero_telefonico"];
            $tel->id_cliente = $cliente[1];
            $tel->add();

			Core::addToastr('success','Cliente agregado con exito');
			Core::redir("./?view=clientes&opt=all");
			
	}
	
	if(isset($_GET["opt"]) && $_GET["opt"] == "update"){
		//deben coincidir con los atribitos name de la etiqueta del formulario
			//var_dump($_POST)

            $dir = DireccionData::getbyID($_POST["id_direccion"]);
            $dir->calle = $_POST["calle"];
            $dir->numero = intval($_POST["numero"]);
            $dir->colonia = $_POST["colonia"];
            $dir->ciudad = $_POST["ciudad"];
            $respuesta = $dir-> update();


			$c = ClienteData::getbyID($_POST["id_cliente"]);
			
			$c->nombre = $_POST["nombre"];
			$c->status = intval($_POST["estado"]);
			//$c->id_direccion = $_POST["id_direccion"];
			
			$c-> update();
			
			Core::addToastr('success','Cliente agregado con exito');
			Core::redir("./?view=clientes&opt=all");

	}

	if(isset($_GET["opt"]) && $_GET["opt"] == "delete"){

			$c = UserData::getByID($_GET["id"]);
			//$u->delete();
			$c->darBaja();
		
			Core::addToastr('success','Cliente eliminado con exito');
			Core::redir("./?view=clientes&opt=all");

	}

?>