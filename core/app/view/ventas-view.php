<?php

	if(!isset($_SESSION["user_id"])){
		Core::redir("./");
	}

	if(isset($_GET["opt"]) && $_GET["opt"] == "all"){
		
		$listaVentas = VentaData::getVenta();
		//var_dump($listaVentas);

?>

        <div class=" table-responsive m-4">
        <a class="btn btn-primary" href="./?view=ventas&opt=add"> Nuevo </a>
            <?php
                if(count($listaVentas)>0){
            ?>

            <div class= "card iq-document-card">
                <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center m-4">
                    <h2><?php echo "Ventas"; ?></h2>
                </div>
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
                                <td> <?php echo $prod->precio;?> </td>
                                <td> <?php echo $row->descuento;?> </td>
                                <td> <?php echo $detvent->monto;?> </td>


                                <!-- <td> <?php echo $row->precio;?> </td>
                                <td> <?php echo $row->stock;?> </td>
                                <td> <?php echo $prov->nombre;?> </td>
                                <td> <?php echo $cat->nombre?> </td> -->

                                <td> <a href="./?view=ventas&opt=edit&id= <?php echo $row->id_venta;?> "> Ver/Editar </a></td>
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
                <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center">
                    <h2> Nueva venta</h2>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">			
                        <form method="post" action="./?action=ventas&opt=add">

                            <div class="mb-3">
                                    <label for="Select" class="form-label">Cliente</label>
                                    <select id="Select" class="form-select" name = "id_cliente">


                                    <?php
                                        foreach($listaClientes as $key => $cl){
                                    ?>
                                        <option value = "<?php echo $cl->id_cliente ?>"> <?php echo $cl->nombre ?> </option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                            </div>

                            <div class="mb-3 form-floating">
                                <input type="date" class="form-control" name="fecha">
                                <label for="floatingInput1">Fecha</label>
                            </div>


                            <div class="mb-3">
                                <label for="Select" class="form-label">Producto</label>
                                <select id="Select" class="form-select" name = "id_producto">
                                <?php
                                    foreach($listaProductos as $key => $prod){
                                ?>
                                    <option value = "<?php echo $prod->id_producto ?>"> <?php echo $prod->nombre ?> </option>
                                <?php
                                    }
                                ?>
                                </select>
                            </div>


                            <div class="mb-3 form-floating">
                                <input type="number" class="form-control" name="cantidad">
                                <label for="floatingInput1">Cantidad</label>
                            </div> 

                            <div class="mb-3 form-floating">
                                <input type="number" readonly class="form-control" name="monto">
                                <label for="floatingInput1">Precio</label>
                            </div>

                            <div class="mb-3 form-floating">
                                <input type="number" class="form-control" name="descuento">
                                <label for="floatingInput1">Descuento</label>
                            </div>

                            <!-- <div class="mb-3 form-floating">
                                <input type="number" class="form-control" name="monto total">
                                <label for="floatingInput1">Monto final</label>
                            </div> -->


                            <div class="mb-3 form-floating text-end">
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </div>	

                        </form>
                    </div>
                </div>
            </div>
        </div>
	

	
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
                    <h2> Editar Venta</h2>
                </div>
                <br>		
                <div class="card">
                    <div class="card-body">		
					<form method="post" action="./?action=ventas&opt=update">

                        <div class="mb-3">
                                <label for="Select" class="form-label">Cliente</label>
                                <select id="Select" class="form-select" name = "id_cliente">

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
							<input type="date" class="form-control" name="fecha" value= "<?php echo $vent->fecha?>">
							<label for="floatingInput1">Fecha</label>
						</div>


                        <div class="mb-3">
                            <label for="Select" class="form-label">Producto</label>
                            <select id="Select" class="form-select" name = "id_producto">


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
							<input type="number" class="form-control" name="cantidad" value= "<?php echo $detvent->cantidad?>">
							<label for="floatingInput1">Cantidad</label>
						</div> 

						<div class="mb-3 form-floating">
							<input type="number" class="form-control" name="monto" value= "<?php echo $vent->monto?>">
							<label for="floatingInput1">Monto</label>
						</div>

                        <div class="mb-3 form-floating">
							<input type="number" class="form-control" name="descuento" value= "<?php echo $vent->descuento?>">
							<label for="floatingInput1">Descuento</label>
						</div>
                        
                        <!-- <div class="mb-3 form-floating">
							<input type="number" class="form-control" name="monto total">
							<label for="floatingInput1">Monto final</label>
						</div> -->


                        <div class="mb-3 form-floating">
							<input type="hidden" class="form-control" name="id_venta" value= "<?php echo $detvent->id_venta?>">
							
						</div>


						<div class="mb-3 form-floating text-end">
		    				<button type="submit" class="btn btn-primary">Actualizar</button>

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