<?php

	if(!isset($_SESSION["user_id"])){
		Core::redir("./");
	}

	if(isset($_GET["opt"]) && $_GET["opt"] == "all"){
		
		$listaProveedor = ProveedorData::getproveedores();
		//var_dump($listaProveedor);

?>

        <div class=" table-responsive m-4">

            <?php
                if(count($listaProveedor)>0){
            ?>

            <div class= "card iq-document-card">
                <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center m-4">
                    <h2>Proveedores</h2>
                    <a class="btn btn-primary" href="./?view=proveedores&opt=add"> Nuevo </a>
                </div>
                <table  class="table table-striped">
                    <thead>
                    <tr class="table-primary">
                        <th scope="col"> ID </th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Sitio web</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    

                        <?php
                            foreach($listaProveedor as $key => $row){
                        ?>
                            <tr>
                                <th scope="row"> <?php echo $row->id_proveedor;?> </th>
                                <td> <?php echo $row->nombre;?> </td>
                                <td> <?php echo $row->telefono;?> </td>
                                <td> <?php echo $row->sitio_web;?> </td>
                                <td> <a href="./?view=proveedores&opt=edit&id= <?php echo $row->id_proveedor;?> "> Ver/Editar </a></td>
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
	?>



        <div class=" table-responsive mx-4">
            <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center">
                <h2> Nuevo Proveedor</h2>
            </div>
            <br>
            <div class="card">
                <div class="card-body">			
                    <form method="post" action="./?action=proveedores&opt=add">
                        <h5> Datos generales </h5>
                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control"  name="nombre">
                            <label for="floatingInput1">Nombre</label>
                        </div>

                        <div class="mb-3 form-floating">
                            <input type="number" class="form-control"  name="telefono">
                            <label for="floatingInput1">Numero telefonico</label>
                        </div>

                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control"  name="sitio_web">
                            <label for="floatingInput1">Sitio web</label>
                        </div>

                        <h5> Direccion </h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 form-floating">
                                    <input type="text" class="form-control"  name="calle">
                                    <label for="floatingInput1">Calle</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3 form-floating">
                                    <input type="text" class="form-control" name="numero">
                                    <label for="floatingInput1">Numero</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 form-floating">
                            <input type="tetx" class="form-control" name="colonia">
                            <label for="floatingInput1">Colonia</label>
                        </div>


                        <div class="mb-3 form-floating">
                            <input type="tetx" class="form-control" name="ciudad">
                            <label for="floatingInput1">Ciudad</label>
                        </div>
                        <div class="mb-3 form-floating text-end">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>	
                    </form>
                </div>
            </div>
        </div>
	<?php
	}
	if(isset($_GET["opt"]) && $_GET["opt"] == "edit"){
		if(!isset($_GET["id"]) or $_GET["id"] == ""){
			Core::addToastr('info','Error');
			Core::redir("../?view=clientes&opt=all");
		}
		
		$proveedor = ProveedorData::getbyID($_GET["id"]);
		$found = False;
		if($proveedor!=Null){
			$found = True;
		}
		if($found){
            $direccion = DireccionData::getbyID($proveedor->id_direccion);
	?>

            <div class=" table-responsive m-4">
                <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center">
                    <h2> Editar proveedor > <?php  echo $proveedor->nombre; ?> </h2>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">			
                        <form method="post" action="./?action=proveedores&opt=update">
                            <h5> Datos generales </h5>
                            <div class="mb-3 form-floating">
                                <input type="hidden" class="form-control" name="id_proveedor" value="<?php  echo$proveedor->id_proveedor; ?>">
                            </div>

                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" name="nombre" value="<?php  echo$proveedor->nombre; ?>">
                                <label for="floatingInput1">Nombre</label>
                            </div>
                            <!-- <a a href="./?action=numeros&opt=add&id= <?php echo $proveedor->id_cliente;?>"  class="btn btn-warning"> Agregar numero </a> -->

                            <div class="mb-3 form-floating">
                                <input type="number" class="form-control" name="telefono" value="<?php  echo$proveedor->telefono; ?>">
                                <label for="floatingInput1">Telefono</label>
                            </div>

                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" name="sitio_web" value="<?php  echo$proveedor->sitio_web; ?>">
                                <label for="floatingInput1">Sitio web</label>
                            </div>

                            <h5> Direccion </h5>
                            <div class="mb-3 form-floating">
                                <input type="hidden" class="form-control" name="id_direccion" value="<?php  echo $direccion->id_direccion; ?>">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 form-floating">
                                        <input type="text" class="form-control" name="calle"  value="<?php  echo$direccion->calle; ?>">
                                        <label for="floatingInput1">Calle</label>
                                    </div>
                                </div>

                            <div class="col-md-6">
                                    <div class="mb-3 form-floating">
                                        <input type="text" class="form-control" name="numero" value="<?php  echo$direccion->numero; ?>">
                                        <label for="floatingInput1">Numero</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 form-floating">
                                <input type="tetx" class="form-control" name="colonia" value="<?php  echo$direccion->colonia; ?>">
                                <label for="floatingInput1">Colonia</label>
                            </div>


                            <div class="mb-3 form-floating">
                                <input type="tetx" class="form-control" name="ciudad" value="<?php  echo$direccion->ciudad; ?>">
                                <label for="floatingInput1">Ciudad</label>
                            </div>
                            <div class="mb-3 form-floating text-end">
                                <button type="submit" class="btn btn-primary">Actualizar datos</button>
                            </div>	
                        </form>
                    </div>
                </div>
            </div>

<?php
		}
	}
?>