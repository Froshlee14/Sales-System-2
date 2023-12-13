<script>
function validarFormulario() {
    var clientInput = document.getElementById('cliente').value;
    var fechaInput = document.getElementById('fecha').value;
    var productInput = document.getElementById ('producto_select').value;
    var cantidadInput = document.getElementById ('cantidad').value;
    var descInput = document.getElementById ('descuento').value;

    if (clientInput == '0' || fechaInput == '' || productInput == '' || cantidadInput == '' || descInput == '') {
        alert("Existen campos vacios");
        return false;
    }

    return true;
}
</script>

<?php

	if(!isset($_SESSION["user_id"])){
		Core::redir("./");
	}

	if(isset($_GET["opt"]) && $_GET["opt"] == "all"){
		
		$listaVentas = VentaData::getVenta();
		//var_dump($listaVentas);

?>

        <div class=" table-responsive m-4">

            <div class= "card iq-document-card">
                <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center m-4">
                    <h2><?php echo "Ventas"; ?></h2>
                    <a class="btn btn-primary" href="./?view=ventas&opt=add"> Nuevo </a>
                </div>
                <?php
                if(count($listaVentas)>0){
            ?>
                <table  class="table table-striped">
                    <thead>
                    <tr  class="table-primary">
                        <th scope="col"> ID </th>
                        <!-- <th scope="col">Cliente</th> -->
                        <th scope="col">Fecha</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Monto</th>
                        <th scope="col">Descuento</th>
                        <th scope="col">Monto Total</th>
                        <th> Acciones </th>

                    </tr>
                    </thead>
                    <tbody>
                    

                        <?php
                            foreach($listaVentas as $key => $row){

                                //$venta = VentaData::getbyID($row->id_venta);
                                $client = ClienteData::getbyID($row->id_cliente);
                                
                                $detvent = Detalles_VentaData::getbyID($row->id_venta);

                                $prod = ProductoData::getByID($detvent->id_producto);

                        ?>
                            <tr>
                                <th scope="row"> <?php echo $row->id_venta;?> </th>
                                <!-- <td> <?php echo $client->nombre;?> </td> -->
                                <td> <?php echo $row->fecha;?> </td>
                                <td> <?php echo $prod->nombre;?> </td>
                                <td> <?php echo $detvent->cantidad;?> </td>
                                <td> <?php echo $row->monto;?> </td>
                                <td> <?php echo $row->descuento;?> </td>
                                <td> <?php echo $detvent->monto;?> </td>


                                <!-- <td> <?php echo $row->precio;?> </td>
                                <td> <?php echo $row->stock;?> </td>
                                <td> <?php echo $prov->nombre;?> </td>
                                <td> <?php echo $cat->nombre?> </td> -->

                                <td> <a href="./?view=ventas&opt=edit&id= <?php echo $row->id_venta;?> "> Ver detalles </a></td>
                                <!-- <td> <a href="./?action=users&opt=delete&id= <?php echo $row->id;?> " class"btn btn-warning"> Eliminar </a></td> -->
                            </tr>
                        
                        <?php
                            }
                        ?>
                    
                    </tbody>
                </table>
            </div>
        </div>


		
	<?php
		}
		else{
	?>
        <div class="alert alert-bottom alert-danger alert-dismissible fade show " role="alert">
            <span> No hay registros</span>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
	<?php
		}
	}
    
	if(isset($_GET["opt"]) && $_GET["opt"] == "add"){

        $listaVentas = VentaData::getVenta();
        $listaClientes = ClienteData::getclientes();
        $listaProductos = ProductoData::getproducts();
        // $listaproveedores = ProveedorData::getproveedores();
        // $listacategorias = CategoriaData::getcategorias();

	?>

            <div class=" table-responsive mx-4">

                <br>
                <div class="card">
                    <div class="card-body">			
                        <form action="/Sales-System-2/ventas-action" method="post" onsubmit="return validarFormulario()">

                            <div class="mb-3">
                                    <label for="Select" class="form-label">Cliente</label>
                                    <select  class="form-select" name = "id_cliente" id="cliente">

                                    <?php
                                    if(count($listaClientes) > 0 ){
                                        foreach($listaClientes as $key => $cl){
                                    ?>
                                        <option value = "<?php echo $cl->id_cliente ?>"> <?php echo $cl->nombre ?> </option>
                                    <?php
                                        }
                                    }
                                    else {
                                    ?>
                                    <option value="0">No hay clientes</option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                            </div>

                            <div class="mb-3 form-floating">
                                <input type="date" class="form-control" name="fecha" id="fecha">
                                <label for="floatingInput1">Fecha</label>
                            </div>


                            <div class="mb-3">
                                <label for="Select" class="form-label">Producto</label>
                                <select id="producto_select" class="form-select" name = "id_producto" onclick="tuFuncion()">
                                <?php
                                    foreach($listaProductos as $key => $prod){
                                ?>
                                    <option value = "<?php echo $prod->id_producto ?>" data-precio="<?php echo $prod->precio; ?>">
                                        <?php echo $prod->nombre ?>
                                    </option>
                                <?php
                                    }
                                ?>
                                </select>
                            </div>

                            <div class="mb-3 form-floating">
                                <input type="number" readonly class="form-control" name="monto" id="monto">
                                <label for="floatingInput1">Monto</label>
                            </div>


                            <div class="mb-3 form-floating">
                                <input type="number" class="form-control" name="cantidad">
                                <label for="floatingInput1">Cantidad</label>
                            </div> 

                            <div class="mb-3 form-floating">
                                <input id="descuento" type="number" class="form-control" name="descuento">
                                <label for="floatingInput1">Descuento</label>
                            </div>

                            <!-- <div class="mb-3 form-floating">
                                <input type="number" class="form-control" name="monto total">
                                <label for="floatingInput1">Monto final</label>
                            </div> -->


                            <div class="mb-3 form-floating text-end">
                                <input type="submit" value = "add" name = "opt" class="btn btn-primary"></button>
                            </div>	

                        </form>
                    </div>
                </div>
            </div>
        </div>
	
        <script>
            function tuFuncion() {
                var selectElement = document.getElementById('producto_select');
                var inputText = document.getElementById("monto");
                inputText.value = selectElement.options[selectElement.selectedIndex].getAttribute('data-precio');
            }
        </script>

	
	<?php
	}

	if(isset($_GET["opt"]) && $_GET["opt"] == "edit"){
		if(!isset($_GET["id"]) or $_GET["id"] == ""){
			Core::addToastr('info','Error');
			Core::redir("../?view=ventas&opt=all");
		}
		
		$vent = VentaData::getbyID($_GET["id"]);
		$found = False;
		if($vent!=Null){
			$found = True;
		}
		if($found){

            //$listaVentas = VentaData::getVenta();
            $detvent = Detalles_VentaData::getbyID($vent->id_venta);
            $listaClientes = ClienteData::getclientes();
            $listaProductos = ProductoData::getproducts();
	?>

            <div class=" table-responsive m-4">
                <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center">
                    <h2> Detalles de Venta</h2>
                </div>
                <br>		
                <div class="card">
                    <div class="card-body">		
					<form method="post" action="./?action=ventas&opt=update">

                        <div class="mb-3">
                                <label for="Select" class="form-label">Cliente</label>
                                <select id="Select" disabled class="form-select" name = "id_cliente">

                                <?php
                                    foreach($listaClientes as $key => $cl){
                                ?>
                                    <option value = "<?php echo $cl->id_cliente ?>"  <?php if ($cl->id_cliente == $vent->id_cliente) echo "selected" ?> >  <?php echo $cl->nombre ?> </option>
                                <?php
                                    }
                                ?>
                                </select>
                        </div>

						<div class="mb-3 form-floating">
							<input type="date" disabled class="form-control" name="fecha" value= "<?php echo $vent->fecha?>">
							<label for="floatingInput1">Fecha</label>
						</div>


                        <div class="mb-3">
                            <label for="Select" class="form-label">Producto</label>
                            <select id="Select" disabled class="form-select" name = "id_producto">


                            <?php
                                foreach($listaProductos as $key => $prod){
                            ?>
                                <option value = "<?php echo $prod->id_producto ?>" <?php if ($prod->id_producto == $detvent->id_producto) echo "selected" ?>  > <?php echo $prod->nombre ?> </option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>


						<div class="mb-3 form-floating">
							<input id="cantidad" disabled class="form-control" name="cantidad" value= "<?php echo $detvent->cantidad?>">
							<label for="floatingInput1">Cantidad</label>
						</div> 

						<div class="mb-3 form-floating">
							<input type="number" disabled class="form-control" name="monto" value= "<?php echo $vent->monto?>">
							<label for="floatingInput1">Monto</label>
						</div>

                        <div class="mb-3 form-floating">
							<input type="number" disabled class="form-control" name="descuento" value= "<?php echo $vent->descuento?>">
							<label for="floatingInput1">Descuento</label>
						</div>


                        <div class="mb-3 form-floating">
							<input type="hidden" class="form-control" name="id_venta" value= "<?php echo $detvent->id_venta?>">
							
						</div>


						<div class="mb-3 form-floating text-end">

                            <a href="./?action=ventas&opt=delete&id= <?php echo $vent->id_venta;?> " class = "btn btn-danger"> Eliminar </a>
						</div>	


					</form>
                    </div>
                </div>
            </div>





<?php
		}
	}
?>