<?php

	if(!isset($_SESSION["user_id"])){
		Core::redir("./");
	}
	
	if(isset($_GET["opt"]) && $_GET["opt"] == "add"){
		//deben coincidir con los atribitos name de la etiqueta del formulario
		var_dump($_POST);
		if(isset($_POST["nombre"])){
			//var_dump($_POST)
			$ca = new CategoriaData();
			$ca->nombre = $_POST["nombre"];
			$ca->descripcion = $_POST["descripcion"];
			
			$ca-> addCat();
			echo "agregado";
			//Core::addToastr('success','Usuario agregado on exito');
			Core::redir("./?view=categoria&opt=all");
			
		}
		else{
			echo "No";
		}
	}
	
	if(isset($_GET["opt"]) && $_GET["opt"] == "update"){
		//deben coincidir con los atribitos name de la etiqueta del formulario
			//var_dump($_POST)
			$ca = CategoriaData::getbyID($_POST["id_categoria"]);
			
			$ca->nombre = $_POST["nombre"];
			$ca->descripcion = $_POST["descripcion"];
			
			$ca-> update();
			
			echo "actualizado";
			//Core::addToastr('success','Usuario agregado on exito');
			Core::redir("./?view=categoria&opt=all");

	}

	if(isset($_GET["opt"]) && $_GET["opt"] == "delete"){

			$ca = CategoriaData::getByID($_GET["id_categoria"]);
			$ca->delete();
			//$c->darBaja();
		
			
			echo "registro eliminado";
			//Core::addToastr('success','Usuario eliminado con exito');
			Core::redir("./?view=categoria&opt=all");

	}

?>