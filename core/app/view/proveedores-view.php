<?php

if (!isset($_SESSION["user_id"])) {
    Core::redir("./");
}

if (isset($_GET["opt"]) && $_GET["opt"] == "all") {

    $listaProveedor = ProveedorData::getproveedores();
    $listaProveedorInactivo = ProveedorData::getproveedoresInactivos();

    //var_dump($listaProveedor);

    ?>

    <div class="table-responsive m-4">

        <div class="card iq-document-card">
            <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center m-4">
                <h2>Proveedores</h2>
                <a class="btn btn-primary" href="./?view=proveedores&opt=add"> Nuevo </a>
            </div>

            <?php
            if (count($listaProveedor) > 0) {
                ?>
                <div class="table-responsive mx-4">

                    <table class="table table-striped">
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
                            foreach ($listaProveedor as $key => $row) {
                                ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $row->id_proveedor; ?>
                                    </th>
                                    <td>
                                        <?php echo $row->nombre; ?>
                                    </td>
                                    <td>
                                        <?php echo $row->telefono; ?>
                                    </td>
                                    <td>
                                        <?php echo $row->sitio_web; ?>
                                    </td>
                                    <td> <a href="./?view=proveedores&opt=edit&id= <?php echo $row->id_proveedor; ?> "> Ver/Editar
                                        </a></td>
                                    <!-- <td> <a href="./?action=users&opt=delete&id= <?php echo $row->id; ?> " class"btn btn-warning"> Eliminar </a></td> -->
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
            if (count($listaProveedorInactivo) > 0) {
                ?>

            <div class="card iq-document-card">
                <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center m-4">
                    <h2>Proveedores inactivos</h2>
                </div>
                <div class="table-responsive mx-4">
                    <table class="table table-striped">
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
                            foreach ($listaProveedorInactivo as $key => $row) {
                                ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $row->id_proveedor; ?>
                                    </th>
                                    <td>
                                        <?php echo $row->nombre; ?>
                                    </td>
                                    <td>
                                        <?php echo $row->telefono; ?>
                                    </td>
                                    <td>
                                        <?php echo $row->sitio_web; ?>
                                    </td>
                                    <td> <a href="./?view=proveedores&opt=edit&id= <?php echo $row->id_proveedor; ?> "> Ver/Editar
                                        </a>
                                    </td>
                                    <!-- <td> <a href="./?action=users&opt=delete&id= <?php echo $row->id; ?> " class"btn btn-warning"> Eliminar </a></td> -->
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
            if (count($listaProveedor) == 0 && count($listaProveedorInactivo) == 0) {
                ?>
            <div class="alert alert-bottom alert-danger alert-dismissible fade show " role="alert">
                <span> No hay registros</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        </div>
        <?php
            }
}
if (isset($_GET["opt"]) && $_GET["opt"] == "add") {
    ?>



    <div class=" table-responsive mx-4">
        <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center">
            <h2> Nuevo Proveedor</h2>
        </div>
        <br>
        <div class="card">
            <div class="card-body">
                <form method="post" action="./?action=proveedores&opt=add" class="needs-validation" novalidate>
                    <h5> Datos generales </h5>
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" name="nombre" required>
                        <label for="floatingInput1">Nombre</label>
                        <div class="invalid-feedback">Por favor, complete este campo.</div>
                    </div>

                    <div class="mb-3 form-floating">
                        <input type="number" class="form-control" name="telefono" required>
                        <label for="floatingInput1">Numero telefonico</label>
                        <div class="invalid-feedback">Por favor, complete este campo.</div>
                    </div>

                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" name="sitio_web" required>
                        <label for="floatingInput1">Sitio web</label>
                        <div class="invalid-feedback">Por favor, complete este campo.</div>
                    </div>

                    <h5> Direccion </h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" name="calle" required>
                                <label for="floatingInput1">Calle</label>
                                <div class="invalid-feedback">Por favor, complete este campo.</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3 form-floating">
                                <input type="number" class="form-control" name="numero" required min="0">
                                <label for="floatingInput1">Numero</label>
                                <div class="invalid-feedback">Por favor, complete este campo.</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 form-floating">
                        <input type="tetx" class="form-control" name="colonia" required>
                        <label for="floatingInput1">Colonia</label>
                        <div class="invalid-feedback">Por favor, complete este campo.</div>
                    </div>


                    <div class="mb-3 form-floating">
                        <input type="tetx" class="form-control" name="ciudad" required>
                        <label for="floatingInput1">Ciudad</label>
                        <div class="invalid-feedback">Por favor, complete este campo.</div>
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
if (isset($_GET["opt"]) && $_GET["opt"] == "edit") {
    if (!isset($_GET["id"]) or $_GET["id"] == "") {
        Core::addToastr('info', 'Error');
        Core::redir("../?view=clientes&opt=all");
    }

    $proveedor = ProveedorData::getbyID($_GET["id"]);
    $found = False;
    if ($proveedor != Null) {
        $found = True;
    }
    if ($found) {
        $direccion = DireccionData::getbyID($proveedor->id_direccion);
        ?>

        <div class=" table-responsive m-4">
            <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center">
                <h2> Editar proveedor >
                    <?php echo $proveedor->nombre; ?>
                </h2>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <form method="post" action="./?action=proveedores&opt=update" class="needs-validation" novalidate>
                        <h5> Datos generales </h5>
                        <div class="mb-3 form-floating">
                            <input type="hidden" class="form-control" name="id_proveedor"
                                value="<?php echo $proveedor->id_proveedor; ?>">
                        </div>

                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control" name="nombre" value="<?php echo $proveedor->nombre; ?>"
                                required>
                            <label for="floatingInput1">Nombre</label>
                            <div class="invalid-feedback">Por favor, complete este campo.</div>
                        </div>

                        <div class="mb-3">
                            <label for="Select" class="form-label mx-1">Estado</label>
                            <select id="Select" class="form-select" name="estado" required>
                                <option value="1" <?php if ($proveedor->status == 1)
                                    echo "selected" ?>> Activo </option>
                                    <option value="0" <?php if ($proveedor->status == 0)
                                    echo "selected" ?>> Inactivo </option>
                                </select>
                                <div class="invalid-feedback">Por favor, selecciona un campo.</div>
                            </div>

                            <div class="mb-3 form-floating">
                                <input type="number" class="form-control" name="telefono"
                                    value="<?php echo $proveedor->telefono; ?>" required>
                            <label for="floatingInput1">Telefono</label>
                            <div class="invalid-feedback">Por favor, complete este campo.</div>
                        </div>

                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control" name="sitio_web"
                                value="<?php echo $proveedor->sitio_web; ?>" required>
                            <label for="floatingInput1">Sitio web</label>
                            <div class="invalid-feedback">Por favor, complete este campo.</div>
                        </div>

                        <h5> Direccion </h5>
                        <div class="mb-3 form-floating">
                            <input type="hidden" class="form-control" name="id_direccion"
                                value="<?php echo $direccion->id_direccion; ?>">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 form-floating">
                                    <input type="text" class="form-control" name="calle"
                                        value="<?php echo $direccion->calle; ?>" required>
                                    <label for="floatingInput1">Calle</label>
                                    <div class="invalid-feedback">Por favor, complete este campo.</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3 form-floating">
                                    <input type="number" class="form-control" name="numero"
                                        value="<?php echo $direccion->numero; ?>" required min="0">
                                    <label for="floatingInput1">Numero</label>
                                    <div class="invalid-feedback">Por favor, complete este campo.</div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 form-floating">
                            <input type="tetx" class="form-control" name="colonia" value="<?php echo $direccion->colonia; ?>"
                                required>
                            <label for="floatingInput1">Colonia</label>
                            <div class="invalid-feedback">Por favor, complete este campo.</div>
                        </div>


                        <div class="mb-3 form-floating">
                            <input type="tetx" class="form-control" name="ciudad" value="<?php echo $direccion->ciudad; ?>"
                                required>
                            <label for="floatingInput1">Ciudad</label>
                            <div class="invalid-feedback">Por favor, complete este campo.</div>
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