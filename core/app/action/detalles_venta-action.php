<?php
/*
	if(!isset($_SESSION["user_id"])){
		Core::redir("./");
	}
	
	if(isset($_GET["opt"]) && $_GET["opt"] == "add"){
		//deben coincidir con los atribitos name de la etiqueta del formulario
		var_dump($_POST);
			//var_dump($_POST)
			$dv = new Detalles_VentaData();
			$dv->id_venta = $_POST["id_venta"];
			$dv->id_producto = $_POST["id_producto"];
            $dv->cantidad = $_POST["cantidad"];
            $dv->monto = $_POST["monto"];
			
			$dv-> add();
			Core::addToastr('success','Usuario agregado on exito');
			Core::redir("./?view=detallesventa&opt=all");
			
	}
	

	if(isset($_GET["opt"]) && $_GET["opt"] == "delete"){

			$dv = Detalles_VentaData::getByID($_GET["id_venta"]);
			$dv->delete();
			//$c->darBaja();
		
			
			echo "registro eliminado";
			//Core::addToastr('success','Usuario eliminado con exito');
			Core::redir("./?view=detallesventa&opt=all");

	}
*/
?>