<?php

	if(!isset($_SESSION["user_id"])){
		Core::redir("./");
	}
	
	if(isset($_POST["opt"]) && $_POST["opt"] == "add"){
		//deben coincidir con los atribitos name de la etiqueta del formulario
		var_dump($_POST);
		if(isset($_POST["descuento"])){
			//var_dump($_POST)
			$ve = new VentaData();
			
			//$ve->fecha = $_POST["fecha"];

			$fechaFormulario = $_POST["fecha"];
			$fechaFormateada = date('Y-m-d', strtotime($fechaFormulario));

			$ve->fecha = $fechaFormateada;

			$ve->descuento = $_POST["descuento"];
            $ve->id_cliente = $_POST["id_cliente"];
            $ve->monto = $_POST["monto"];
			$respuesta = $ve->addvent();

			$dv = new Detalles_VentaData();
			$dv->id_producto= $_POST["id_producto"];
			$dv->cantidad= $_POST["cantidad"];
			$dv->id_venta= $respuesta[1];
			$dv->monto= ($_POST["monto"] - $_POST["descuento"]) * $_POST["cantidad"];

			$dv->add();

			echo "agregado";
			Core::addToastr('success','Usuario agregado on exito');
			Core::redir("./?view=ventas&opt=all");
			
		}
		else{
			echo "No";
		}
	}
	
	if(isset($_GET["opt"]) && $_GET["opt"] == "update"){
		//deben coincidir con los atribitos name de la etiqueta del formulario
			//var_dump($_POST)
			$ve = VentaData::getbyID($_POST["id_venta"]);
			
			$fechaFormulario = $_POST["fecha"];
			$fechaFormateada = date('Y-m-d', strtotime($fechaFormulario));

			$ve->fecha = $fechaFormateada;
			
			$ve->descuento = $_POST["descuento"];
			$ve->id_cliente = $_POST["id_cliente"];
            $ve->monto = $_POST["monto"];
            
			$ve-> update();
			
			$dv = new Detalles_VentaData();
			$dv->id_producto= $_POST["id_producto"];
			$dv->cantidad= $_POST["cantidad"];
			$dv->id_venta= $_POST["id_venta"];
			$dv->monto= ($_POST["monto"] - $_POST["descuento"])*$_POST["cantidad"];

			$dv->update();

			echo "actualizado";
			//Core::addToastr('success','Usuario agregado on exito');
			Core::redir("./?view=ventas&opt=all");

	}

	if(isset($_GET["opt"]) && $_GET["opt"] == "delete"){

			
			$ve = VentaData::getbyID($_GET["id"]);
			$dv = Detalles_VentaData::getbyID($_GET["id"]);
			
			$dv->delete();
			$ve->delete();
			
			echo "registro eliminado";
			//Core::addToastr('success','Usuario eliminado con exito');
			Core::redir("./?view=ventas&opt=all");

	}

?>