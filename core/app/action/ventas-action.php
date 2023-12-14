<?php

	if(!isset($_SESSION["user_id"])){
		Core::redir("./");
	}
	
	if(isset($_GET["opt"]) && $_GET["opt"] == "add"){
		//deben coincidir con los atribitos name de la etiqueta del formulario
		var_dump($_POST);
			//var_dump($_POST)
			$ve = new VentaData();
			
			//$ve->fecha = $_POST["fecha"];

			$fechaFormulario = $_POST["fecha"];
			$fechaFormateada = date('Y-m-d', strtotime($fechaFormulario));

			$ve->fecha = $fechaFormateada;

			$ve->descuento = $_POST["descuento"];
            $ve->id_cliente = $_POST["id_cliente"];
            $ve->monto = $_POST["monto"];
			

			$dv = new Detalles_VentaData();
			$dv->id_producto= $_POST["id_producto"];
			$prod = ProductoData::getByID($_POST["id_producto"]);
			$dv->cantidad= $_POST["cantidad"];
			if($prod->stock >= $_POST["cantidad"]){
                if($_POST["descuento"]<= $prod->precio){
                    $respuesta = $ve->addvent();

                    $dv->id_venta= $respuesta[1];
                    $dv->monto= ($_POST["monto"] - $_POST["descuento"]) * $_POST["cantidad"];

                    $dv->add();

                    $prod->stock = $prod->stock - $_POST["cantidad"];
                    $prod->update();

                    Core::addToastr('success','Venta realizada con exito');
                    Core::redir("./?view=ventas&opt=all");
                }
                
                else{
                    Core::addToastr('warning','El descuento no puede exceder el precio del producto');
			        Core::redir("./?view=ventas&opt=all");
                }
			}
			
		else{
			Core::addToastr('warning','No hay stock suficiente');
			Core::redir("./?view=ventas&opt=all");
        }
	}
	
	/*if(isset($_GET["opt"]) && $_GET["opt"] == "update"){
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

			Core::addToastr('success','Venta modificada con exito');
			Core::redir("./?view=ventas&opt=all");

	}*/

	if(isset($_GET["opt"]) && $_GET["opt"] == "delete"){

			
			$ve = VentaData::getbyID($_GET["id"]);
			$dv = Detalles_VentaData::getbyID($_GET["id"]);
			
			$dv->delete();
			$ve->delete();
		
			Core::addToastr('success','Venta eliminada con exito');
			Core::redir("./?view=ventas&opt=all");

	}

?>