<?php

	if(!isset($_SESSION["user_id"])){
		Core::redir("./");
	}

	if(isset($_GET["opt"]) && $_GET["opt"] == "all"){
		
		$listaProductos = ProductoData::getproducts();
		//var_dump($listaProductos);

?>

        <div class=" table-responsive m-4">
        <a class="btn btn-primary" href="./?view=productos&opt=add"> Nuevo </a>
            <?php
                if(count($listaProductos)>0){
            ?>

            <div class= "card iq-document-card">
                <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center m-4">
                    <h2><?php echo "Productos"; ?></h2>
                </div>
                <table  class="table table-striped">
                    <thead>
                    <tr class="table-primary">
                        <th scope="col"> ID </th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Proveedor</th>
                        <th scope="col">Categoria</th>
                        <th> Acciones </th>
                    </tr>
                    </thead>
                    <tbody>
                    

                        <?php
                            foreach($listaProductos as $key => $row){

                                $prov = ProveedorData::getbyID($row->id_proveedor);
                                $cat = CategoriaData::getbyID($row->id_categoria);

                        ?>
                            <tr>
                                <th scope="row"> <?php echo $row->id_producto;?> </th>
                                <td> <?php echo $row->nombre;?> </td>
                                <td> <?php echo $row->precio;?> </td>
                                <td> <?php echo $row->stock;?> </td>
                                <td> <?php echo $prov->nombre;?> </td>
                                <td> <?php echo $cat->nombre?> </td>

                                <td> <a href="./?view=productos&opt=edit&id= <?php echo $row->id_producto;?> "> Ver/Editar </a></td>
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

        $listaproveedores = ProveedorData::getproveedores();
        $listacategorias = CategoriaData::getcategorias();

	?>

        <div class=" table-responsive mx-4">
            <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center">
                <h2> Nuevo Producto</h2>
            </div>
            <br>
            <div class="card">
                <div class="card-body">			
                    <form method="post" action="./?action=productos&opt=add">
                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre">
                            <label for="floatingInput1">Nombre</label>
                        </div>

                        <div class="mb-3 form-floating">
                            <input type="number" class="form-control" name="precio">
                            <label for="floatingInput1">Precio</label>
                        </div>

                        <div class="mb-3 form-floating">
                            <input type="number" class="form-control" name="stock">
                            <label for="floatingInput1">Stock</label>
                        </div>


                        <div class="mb-3">
                            <label for="Select" class="form-label">Proveedor</label>
                            <select id="Select" class="form-select" name = "id_proveedor">

                            <?php
                                foreach($listaproveedores as $key => $p){
                            ?>
                                <option value = "<?php echo $p->id_proveedor ?>"> <?php echo $p->nombre ?> </option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="Select" class="form-label">Categoria</label>
                            <select id="Select" class="form-select" name = "id_categoria">

                            <?php
                                foreach($listacategorias as $key => $c){
                            ?>
                                <option value = "<?php echo $c->id_categoria ?>"> <?php echo $c->nombre ?> </option>
                            <?php
                                }
                            ?>
                            </select>
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
			Core::redir("../?view=productos&opt=all");
		}
		
		$prod = ProductoData::getByID($_GET["id"]);
		$found = False;
		if($prod!=Null){
			$found = True;
		}
		if($found){

            $listaproveedores = ProveedorData::getproveedores();
            $listacategorias = CategoriaData::getcategorias();
	?>


            <div class=" table-responsive m-4">
                <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center">
                    <h2> Nuevo Producto</h2>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">			
                        <form method="post" action="./?action=productos&opt=update">
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" value = "<?php echo $prod->nombre ?>" name="nombre">
                                <label for="floatingInput1">Nombre</label>
                            </div>

                            
                            <div class="mb-3 form-floating">
                                <input type="hidden" class="form-control" value = "<?php echo $prod->id_producto ?>" name="id_producto">
                                
                            </div>


                            <div class="mb-3 form-floating">
                                <input type="number" class="form-control" value = "<?php echo $prod->precio ?>" name="precio">
                                <label for="floatingInput1">Precio</label>
                            </div>

                            <div class="mb-3 form-floating">
                                <input type="number" class="form-control" value = "<?php echo $prod->stock ?>" name="stock">
                                <label for="floatingInput1">Stock</label>
                            </div>


                            <div class="mb-3">
                                <label for="Select" class="form-label">Proveedor</label>
                                <select id="Select" class="form-select" name = "id_proveedor">

                                <?php
                                    foreach($listaproveedores as $key => $p){
                                ?>
                                    <option value = "<?php echo $p->id_proveedor ?>"  <?php if ($p->id_proveedor == $prod->id_proveedor) echo "selected" ?> > <?php echo $p->nombre ?> </option>
                                <?php
                                    }
                                ?>
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="Select" class="form-label">Categoria</label>
                                <select id="Select" class="form-select" name = "id_categoria">


                                <?php
                                    foreach($listacategorias as $key => $c){
                                ?>
                                    <option value = "<?php echo $c->id_categoria ?>" <?php if ($c->id_categoria == $prod->id_categoria) echo "selected" ?>> <?php echo $c->nombre ?> </option>
                                <?php
                                    }
                                ?>
                                </select>
                            </div>

                            <div class="mb-3 form-floating text-end">
                                <button type="submit" class="btn btn-primary">Actualizar</button>

                                <a href="./?action=productos&opt=delete&id= <?php echo $prod->id_producto;?> " class = "btn btn-danger"> Eliminar </a>

                            </div>	
                        </form>
                    </div>
                </div>
            </div>
        </div>



<?php
		}
	}
?>