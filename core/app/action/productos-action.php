<?php

	if(!isset($_SESSION["user_id"])){
		Core::redir("./");
	}
	
	if(isset($_GET["opt"]) && $_GET["opt"] == "add"){
		//deben coincidir con los atribitos name de la etiqueta del formulario
		var_dump($_POST);
		if(isset($_POST["nombre"])){
			//var_dump($_POST)
			$p = new ProductoData();
			$p->nombre = $_POST["nombre"];
			$p->precio = $_POST["precio"];
			$p->stock = $_POST["stock"];
            $p->id_proveedor = $_POST["id_proveedor"];
            $p->id_categoria = $_POST["id_categoria"];
			
			$p-> addProd();
			echo "agregado";
			//Core::addToastr('success','Usuario agregado on exito');
			Core::redir("./?view=productos&opt=all");
			
		}
		else{
			echo "No";
		}
	}
	
	if(isset($_GET["opt"]) && $_GET["opt"] == "update"){
		//deben coincidir con los atribitos name de la etiqueta del formulario
			//var_dump($_POST)
			$p = ProductoData::getByID($_POST["id_producto"]);
			
			$p->nombre = $_POST["nombre"];
			$p->precio = $_POST["precio"];
            $p->stock = $_POST["stock"];
			$p->id_proveedor = $_POST["id_proveedor"];
            $p->id_categoria = $_POST["id_categoria"];

			$p-> update();
			
			echo "actualizado";
			//Core::addToastr('success','Usuario agregado on exito');
			Core::redir("./?view=productos&opt=all");

	}

	if(isset($_GET["opt"]) && $_GET["opt"] == "delete"){

			$p = ProductoData::getByID($_GET["id"]);
			$p->delete();
			//$c->darBaja();
		
			
			echo "registro eliminado";
			//Core::addToastr('success','Usuario eliminado con exito');
			Core::redir("./?view=productos&opt=all");

	}

?>