<?php
if (!isset($_SESSION["user_id"])) {
    Core::redir("./");
}

if (isset($_GET["opt"]) && $_GET["opt"] == "all") {
    $listaVentas = VentaData::getVenta();
    //var_dump($listaVentas);
    ?>

    <div class="table-responsive m-4">
        <div class="card iq-document-card">
            <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center m-4">
                <h2>
                    <?php echo "Ventas"; ?>
                </h2>
                <a class="btn btn-primary" href="./?view=ventas&opt=add"> Nuevo </a>
            </div>
            <?php
            if (count($listaVentas) > 0) {
                ?>
                <div class="table-responsive mx-4">
                    <table class="table table-striped">
                        <thead>
                            <tr class="table-primary">
                                <th scope="col"> ID </th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Monto Total</th>
                                <th> Acciones </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($listaVentas as $key => $row) {
                                $client = ClienteData::getbyID($row->id_cliente);
                                $detvent = Detalles_VentaData::getbyID($row->id_venta);
                                $prod = ProductoData::getByID($detvent->id_producto);
                                ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $row->id_venta; ?>
                                    </th>
                                    <td>
                                        <?php echo $row->fecha; ?>
                                    </td>
                                    <td>
                                        <?php echo $detvent->monto; ?>
                                    </td>
                                    <td> <a href="./?view=ventas&opt=Visualizar&id=<?php echo $row->id_venta; ?>"> Ver detalles </a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
            } else {
                ?>
        <div class="alert alert-bottom alert-danger alert-dismissible fade show " role="alert">
            <span> No hay registros</span>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            }
}

if (isset($_GET["opt"]) && $_GET["opt"] == "add") {
    $listaVentas = VentaData::getVenta();
    $listaClientes = ClienteData::getclientes();
    $listaProductos = ProductoData::getproducts();
    ?>

    <div class="table-responsive mx-4">
    <h5 class="card-title"> Datos de venta </h5>
        <div class="card">
            
            <div class="card-body">
                <form action="./?action=ventas&opt=add" method="post" id="ventasForm" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="cliente" class="form-label">Cliente</label>
                        <select class="form-select" name="id_cliente" id="cliente" required>
                            <?php
                            if (count($listaClientes) > 0) {
                                foreach ($listaClientes as $key => $cl) {
                                    ?>
                                    <option value="<?php echo $cl->id_cliente ?>">
                                        <?php echo $cl->nombre ?>
                                    </option>
                                    <?php
                                }
                            } else {
                                ?>
                                <option value="0" disabled>No hay clientes</option>
                                <?php
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">Por favor, seleccione un cliente.</div>
                    </div>

                    <?php
                    // Obtiene la fecha actual en el formato YYYY-MM-DD
                    date_default_timezone_set('America/Mexico_City');
                    $fechaActual = date("Y-m-d");
                    ?>

                    <div class="mb-3 form-floating">
                        <input type="date" class="form-control" name="fecha" id="fecha" required
                            value="<?php echo $fechaActual; ?>" readonly>
                        <label for="fecha">Fecha</label>
                        <div class="invalid-feedback">Por favor, seleccione una fecha.</div>
                    </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="producto_select" class="form-label">Producto</label>
                    <select id="producto_select" class="form-select" name="id_producto" onchange="tuFuncion()" required>
                        <option value="0" data-precio=" " selected> Elige un producto </option>
                        <?php
                        foreach ($listaProductos as $key => $prod) {
                            ?>
                            <option value="<?php echo $prod->id_producto ?>" data-precio="<?php echo $prod->precio; ?>">
                                <?php echo $prod->nombre ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                    <div class="invalid-feedback">Por favor, seleccione un producto.</div>
                </div>

                <div class="mb-3 form-floating">
                    <input type="number" readonly class="form-control" name="monto" id="monto" required>
                    <label for="monto">Precio</label>
                    <div class="invalid-feedback">Por favor, complete este campo.</div>
                </div>

                <div class="mb-3 form-floating">
                    <input type="number" class="form-control" name="cantidad" required min="0">
                    <label for="cantidad">Cantidad</label>
                    <div class="invalid-feedback">Por favor, complete este campo.</div>
                </div>

                <div class="mb-3 form-floating">
                    <input id="descuento" type="number" class="form-control" name="descuento" required min="0">
                    <label for="descuento">Descuento</label>
                    <div class="invalid-feedback">Por favor, complete este campo.</div>
                </div>


                </form>
            </div>
        </div>
        <div class="mb-3 form-floating text-end">
            <button type="submit" class="btn btn-primary">Agregar</button>
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

if (isset($_GET["opt"]) && $_GET["opt"] == "Visualizar") {
    if (!isset($_GET["id"]) or $_GET["id"] == "") {
        Core::addToastr('info', 'Error');
        Core::redir("../?view=ventas&opt=all");
    }

    $vent = VentaData::getbyID($_GET["id"]);
    $found = False;

    if ($vent != Null) {
        $found = True;
    }

    if ($found) {
        $detvent = Detalles_VentaData::getbyID($vent->id_venta);
        $listaClientes = ClienteData::getclientes();
        $listaProductos = ProductoData::getproducts();
        ?>
        <div class="table-responsive m-4">
            <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center">
                <h2> Detalles de Venta</h2>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <form method="post" action="./?action=ventas&opt=update">
                        <div class="mb-3">
                            <label for="Select" class="form-label">Cliente</label>
                            <select id="Select" disabled class="form-select" name="id_cliente">
                                <?php
                                foreach ($listaClientes as $key => $cl) {
                                    ?>
                                    <option value="<?php echo $cl->id_cliente ?>" <?php if ($cl->id_cliente == $vent->id_cliente)
                                           echo "selected" ?>>
                                        <?php echo $cl->nombre ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3 form-floating">
                            <input type="date" disabled class="form-control" name="fecha" value="<?php echo $vent->fecha ?>">
                            <label for="floatingInput1">Fecha</label>
                        </div>

                        <div class="mb-3">
                            <label for="Select" class="form-label">Producto</label>
                            <select id="Select" disabled class="form-select" name="id_producto">
                                <?php
                                foreach ($listaProductos as $key => $prod) {
                                    ?>
                                    <option value="<?php echo $prod->id_producto ?>" <?php if ($prod->id_producto == $detvent->id_producto)
                                           echo "selected" ?>>
                                        <?php echo $prod->nombre ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3 form-floating">
                            <input type="number" disabled class="form-control" name="monto" value="<?php echo $vent->monto ?>">
                            <label for="floatingInput1">Precio</label>
                        </div>

                        <div class="mb-3 form-floating">
                            <input id="cantidad" disabled class="form-control" name="cantidad"
                                value="<?php echo $detvent->cantidad ?>">
                            <label for="floatingInput1">Cantidad</label>
                        </div>

                        <div class="mb-3 form-floating">
                            <input type="number" disabled class="form-control" name="descuento"
                                value="<?php echo $vent->descuento ?>">
                            <label for="floatingInput1">Descuento</label>
                        </div>

                        <div class="mb-3 form-floating">
                            <input type="hidden" class="form-control" name="id_venta" value="<?php echo $detvent->id_venta ?>">
                        </div>

                        <div class="mb-3 form-floating text-end">
                            <a href="./?action=ventas&opt=delete&id=<?php echo $vent->id_venta; ?>" class="btn btn-danger">
                                Eliminar </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
    }
}
?>