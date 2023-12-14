<?php

	if(!isset($_SESSION["user_id"])){
		Core::redir("./");
	}
	
	if(isset($_GET["opt"]) && $_GET["opt"] == "add"){
		//deben coincidir con los atribitos name de la etiqueta del formulario
		var_dump($_POST);
			//var_dump($_POST)
			$dv = new Detalles_VentaData();
            $producto = ProductoData::getByID($_POST["id_producto"]);
            $venta = VentaData::getbyID($_POST["id_venta"]);

            if ($producto->stock >= $_POST["cantidad"]) {
                if($_POST["descuento"] <=  $producto->precio){

                    $dv->id_venta = $_POST["id_venta"];
                    $dv->id_producto = $_POST["id_producto"];
                    
                    $dv->cantidad = $_POST["cantidad"];
                    $dv->descuento = $_POST["descuento"];

                    $dv->monto = ($producto->precio - $_POST["descuento"]) *  $_POST["cantidad"];
                    
                    $dv-> add();

                    $venta->monto = $venta->monto + $dv->monto;
                    $venta->update();

                    $producto->stock = $producto->stock - $_POST["cantidad"];
                    $producto->update();

                    Core::addToastr('success','Producto agregado a la venta');
                    Core::redir("./?view=ventas&opt=add&id_venta={$_POST["id_venta"]}");
                }
                else{
                    Core::addToastr('warning', 'El descuento no puede exceder el precio del producto');
                    Core::redir("./?view=ventas&opt=add&id_venta={$_POST["id_venta"]}");
                }
            }
            else{
                Core::addToastr('warning', 'No hay stock suficiente');
                Core::redir("./?view=ventas&opt=add&id_venta={$_POST["id_venta"]}");
            }
			
	}
	

	if(isset($_GET["opt"]) && $_GET["opt"] == "delete"){

			$dv = Detalles_VentaData::getByID($_GET["id_venta"]);
			$dv->delete();
			//$c->darBaja();
		
			
			echo "registro eliminado";
			//Core::addToastr('success','Usuario eliminado con exito');
			Core::redir("./?view=detallesventa&opt=all");

	}

?>