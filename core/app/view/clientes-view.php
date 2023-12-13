<?php

	if(!isset($_SESSION["user_id"])){
		Core::redir("./");
	}

	if(isset($_GET["opt"]) && $_GET["opt"] == "all"){
		
		$listaClientes = ClienteData::getclientes();
        $listaClientesInactivos = ClienteData::getclientesInactivos();
		//var_dump($listaClientes);

?>

            <div class=" table-responsive m-4">
            <a class="btn btn-primary" href="./?view=clientes&opt=add"> Nuevo </a>

                <?php
		            if(count($listaClientes)>0){
	            ?>

                <div class= "card iq-document-card">
                    <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center m-4">
                        <h2>Clientes</h2>
                    </div>
                    <table  class="table table-bordered"> 
                        <thead>
                            <tr class="table-primary">
                                <th scope="col"> ID </th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        

                            <?php
                                foreach($listaClientes as $key => $row){
                            ?>
                                <tr>
                                    <th scope="row"> <?php echo $row->id_cliente;?> </th>
                                    <td> <?php echo $row->nombre;?> </td>
                                    <td> <a href="./?view=clientes&opt=edit&id= <?php echo $row->id_cliente;?> "> Ver/Editar </a></td>
                                </tr>
                            
                            <?php
                                }
                            ?>
                        
                        </tbody>
                    </table>
                </div>
		
	<?php
		}
        if(count($listaClientesInactivos)>0){
            ?>

            <div class= "card iq-document-card">
                <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center m-4">
                    <h2>Clientes inactivos</h2>
                </div>
                <table  class="table table-bordered"> 
                    <thead>
                        <tr class="table-primary">
                            <th scope="col"> ID </th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    

                        <?php
                            foreach($listaClientesInactivos as $key => $row){
                        ?>
                            <tr>
                                <th scope="row"> <?php echo $row->id_cliente;?> </th>
                                <td> <?php echo $row->nombre;?> </td>
                                <td> <a href="./?view=clientes&opt=edit&id= <?php echo $row->id_cliente;?> "> Ver/Editar </a></td>
                            </tr>
                        
                        <?php
                            }
                        ?>
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


    
<?php
    }
		if(count($listaClientes) == 0 && count($listaClientesInactivos) == 0){
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
                    <h2> Nuevo Cliente</h2>
                </div>
                <br>	
                <div class="card">
                
                    <div class="card-body">		
                        <form method="post" action="./?action=clientes&opt=add">
                            <h5 class="card-title"> Datos generales </h5>
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre">
                                <label for="floatingInput1">Nombre</label>
                            </div>

                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" id="numero_telefonico" placeholder="Numero telefonico" name="numero_telefonico">
                                <label for="floatingInput1">Numero telefonico</label>
                            </div>
                            <h5 class="card-title"> Direccion </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 form-floating">
                                        <input type="text" class="form-control" id="calle" placeholder="Calle" name="calle">
                                        <label for="floatingInput1">Calle</label>
                                    </div>
                                </div>

                            <div class="col-md-6">
                                    <div class="mb-3 form-floating">
                                        <input type="text" class="form-control" id="numero" placeholder="Numero" name="numero">
                                        <label for="floatingInput1">Numero</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 form-floating">
                                <input type="tetx" class="form-control" id="colonia" placeholder="Colonia"name="colonia">
                                <label for="floatingInput1">Colonia</label>
                            </div>


                            <div class="mb-3 form-floating">
                                <input type="tetx" class="form-control" id="ciudad" placeholder="Ciudad"name="ciudad">
                                <label for="floatingInput1">Ciudad</label>
                            </div>
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
			Core::redir("../?view=clientes&opt=all");
		}
		
		$cliente = ClienteData::getByID($_GET["id"]);
		$found = False;
		if($cliente!=Null){
			$found = True;
		}
		if($found){
            $numeros = NumeroTelefonicoData::getbycliente($_GET["id"]);
            $direccion = DireccionData::getbyID($cliente->id_direccion);
	?>




            <div class=" table-responsive m-4">

                <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center">
                    <h2> Editar cliente > <?php  echo $cliente->nombre; ?> </h2>
                </div>
                <br>

                <div class="card">
                <div class="card-body">

					<form method="post" action="./?action=clientes&opt=update">
                        <h5> Datos generales </h5>

                        <div class="mb-3 form-floating">
							<input type="hidden" class="form-control" name="id_cliente" value="<?php  echo$cliente->id_cliente; ?>">
						</div>

						<div class="mb-3 form-floating">
							<input type="text" class="form-control" name="nombre" value="<?php  echo$cliente->nombre; ?>">
							<label for="floatingInput1">Nombre</label>
						</div>

                        <div class="mb-3">
                                <label for="Select" class="form-label mx-1">Estado</label>
                                <select id="Select" class="form-select" name = "estado">
                                    <option value = "1" selected> Activo </option>
                                    <option value = "0"> Inactivo </option>
                                </select>
                        </div>
                        

                        <!-- <a a href="./?action=numeros&opt=add&id= <?php echo $cliente->id_cliente;?>"  class="btn btn-warning"> Agregar numero </a> -->

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

                <div class="card">
                <div class="card-body">

                    <form method="post" action="./?action=numeros&opt=add&id= <?php echo $cliente->id_cliente;?>">
                        <h5> Numeros telefonicos </h5>
                        <div class="mb-3 form-floating">
							<input type="hidden" class="form-control" name="id_cliente" value="<?php  echo$cliente->id_cliente; ?>">
						</div>
                        <div class="bd-example">
                            <ul class="list-group">
                                <?php 
                                    foreach($numeros as $key => $numero){
                                ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?php  echo $numero->numero; ?>
                                        <a href="./?action=numeros&opt=delete&id= <?php echo $numero->id_numero;?>&id_cliente= <?php echo $cliente->id_cliente;?>&"> Quitar </a>
                                    </li>
                                <?php 
                                    }
                                ?>
                            </ul>
                        </div>

                        <div class="input-group mb-3">
                            <input type="number" class="form-control" placeholder="Nuevo número" name="nuevo_numero">
                            <button class="btn btn-primary" type="submit">Agregar número</button>
                        </div>
                    </form>
                
                </div>
                </div>

            </div>

<?php
		}
	}
?>