<?php

	if(!isset($_SESSION["user_id"])){
		Core::redir("./");
	}
	
	if(isset($_GET["opt"]) && $_GET["opt"] == "add"){
		//deben coincidir con los atribitos name de la etiqueta del formulario
		//var_dump($_POST);
			//var_dump($_POST)

            $dir = new DireccionData();
            $dir->calle = $_POST["calle"];
            $dir->numero = intval($_POST["numero"]);
            $dir->colonia = $_POST["colonia"];
            $dir->ciudad = $_POST["ciudad"];
            $respuesta = $dir-> add();

			$pro = new ProveedorData();
			$pro->nombre = $_POST["nombre"];
            $pro->telefono = intval($_POST["telefono"]);
            $pro->sitio_web = $_POST["sitio_web"];
			$pro->id_direccion = $respuesta[1];
			$pro->status = 1;
			
			$pro->add();

			Core::addToastr('success','Proveedor agregado con exito');
			Core::redir("./?view=proveedores&opt=all");
			
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


			$pro = ProveedorData::getbyID($_POST["id_proveedor"]);
			
			$pro->nombre = $_POST["nombre"];
            $pro->telefono = intval($_POST["telefono"]);
            $pro->sitio_web = $_POST["sitio_web"];
			$pro->status = $_POST["estado"];
			
			$pro-> update();
			
			Core::addToastr('success','Proveedor actualizado con exito');
			Core::redir("./?view=proveedores&opt=all");

	}

	if(isset($_GET["opt"]) && $_GET["opt"] == "delete"){

			$c = UserData::getByID($_GET["id"]);
			//$u->delete();
			$c->darBaja();
		
			Core::addToastr('success','Proveedor eliminado con exito');
			Core::redir("./?view=clientes&opt=all");

	}

?>