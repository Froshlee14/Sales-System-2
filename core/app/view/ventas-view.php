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
                <h2> Ventas</h2>
                <a class="btn btn-primary" href="./?view=ventas&opt=add&id_venta=0"> Nuevo </a>
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
                                //$prod = ProductoData::getByID($detvent->id_producto);
                                ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $row->id_venta; ?>
                                    </th>
                                    <td>
                                        <?php echo $row->fecha; ?>
                                    </td>
                                    <td>
                                        <?php echo $row->monto; ?>
                                    </td>
                                    <td> <a href="./?view=ventas&opt=view&id=<?php echo $row->id_venta; ?>"> Ver detalles </a>
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

        <form action="./?action=ventas&opt=add" method="post" id="ventasForm" class="needs-validation" novalidate>
            <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center m-4">
                <h2> Nueva venta </h2>

                <?php
                if ($_GET["id_venta"] != 0) {
                    $venta = VentaData::getbyID($_GET["id_venta"]);
                    $listaDetallesVenta = Detalles_VentaData::getDetallesbyventa($_GET["id_venta"]);
                    ?>

                    <button type="submit" class="btn btn-primary">Guardar venta</button>

                    <?php
                }
                ?>
            </div>
            <div class="card">
                <div class="card-body">

                    <input type="hidden" class="form-control" name="id_venta" id="id_venta"
                        value="<?php echo $_GET["id_venta"] ?>">

                    <div class="mb-3">
                        <label for="cliente" class="form-label">Cliente</label>
                        <select class="form-select" name="id_cliente" id="cliente" required>
                            <?php
                            if (count($listaClientes) > 0) {
                                foreach ($listaClientes as $key => $cliente) {
                                    ?>
                                    <option value="<?php echo $cliente->id_cliente ?>" <?php if ($_GET["id_venta"] != 0) {
                                           if ($venta->id_cliente == $cliente->id_cliente) {
                                               echo "selected";
                                           }
                                       } ?>>
                                        <?php echo $cliente->nombre ?>
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
                        <input type="date" class="form-control" name="fecha" id="fecha" required value="<?php if ($_GET["id_venta"] != 0) {
                            echo $venta->fecha;
                        } else {
                            echo $fechaActual;
                        } ?>" readonly>
                        <label for="fecha">Fecha</label>
                        <div class="invalid-feedback">Por favor, seleccione una fecha.</div>
                    </div>
                </div>
            </div>

            <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center m-4">
                <h2> Productos </h2>
                <button type="submit" class="btn btn-primary">Agregar Producto</button>
            </div>


            <?php
            if ($_GET["id_venta"] != 0) {
                if (count($listaDetallesVenta) > 0) {
                    foreach ($listaDetallesVenta as $key => $detalleventa) {
                        ?>


                        <div class="card">
                            <div class="card-body">
                                <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center m-4">
                                    <label for="monto"> Producto:
                                        <?php echo ProductoData::getByID($detalleventa->id_producto)->nombre ?>
                                    </label>
                                </div>

                                <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center m-4">
                                    <label for="monto"> Cantidad:
                                        <?php echo $detalleventa->cantidad ?>
                                    </label>
                                </div>


                                <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center m-4">
                                    <label for="monto"> Monto:
                                        <?php echo $detalleventa->monto ?>
                                    </label>
                                </div>

                                <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center m-4">
                                    <label for="monto"> Descuento:
                                        <?php echo $detalleventa->descuento ?>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <?php
                    }
                }
                ?>




            </form>
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
}

if (isset($_GET["opt"]) && $_GET["opt"] == "view") {
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
        ?>

        <div class="table-responsive mx-4">

            <form action="./?action=ventas&opt=add" method="post" id="ventasForm" class="needs-validation" novalidate>
                <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center m-4">
                    <h2> Detalles de venta </h2>

                    <?php
                    if ($_GET["id"] != 0) {
                        $venta = VentaData::getbyID($_GET["id"]);
                        $listaDetallesVenta = Detalles_VentaData::getDetallesbyventa($_GET["id"]);
                    }
                    ?>
                </div>
                <div class="card">
                    <div class="card-body">

                        <input type="hidden" class="form-control" name="id_venta" id="id_venta"
                            value="<?php echo $_GET["id"] ?>" readonly>

                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control" name="cliente" id="cliente"
                                value="<?php echo ClienteData::getbyID($vent->id_cliente)->nombre ?>" readonly>
                            <label for="monto">Cliente</label>
                        </div>


                        <div class="mb-3 form-floating">
                            <input type="text" class="form-control" name="fecha" id="fecha" value="<?php echo ($vent->fecha) ?>"
                                readonly>
                            <label for="monto">Fecha</label>
                        </div>


                    </div>
                </div>

                <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center m-4">
                    <h2> Productos </h2>
                    <!-- <button type="submit" class="btn btn-primary">Agregar Producto</button> -->
                </div>

                <?php
                if ($_GET["id"] != 0) {
                    if (count($listaDetallesVenta) > 0) {
                        foreach ($listaDetallesVenta as $key => $detalleventa) {
                            ?>

                            <div class="card">
                                <div class="card-body">

                                    <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center m-4">
                                        <label for="monto"> Producto:
                                            <?php echo ProductoData::getByID($detalleventa->id_producto)->nombre ?>
                                        </label>
                                        <label for="monto"> Cantidad:
                                            <?php echo $detalleventa->cantidad ?>
                                        </label>


                                        <label for="monto"> Monto:
                                            <?php echo $detalleventa->monto ?>
                                        </label>

                                        <label for="monto"> Descuento:
                                            <?php echo $detalleventa->descuento ?>
                                        </label>
                                    </div>


                                </div>
                            </div>
                            <?php
                        }

                    } else {
                        ?>
                        <div class="alert alert-primary d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                                <use xlink:href="#info-fill" />
                            </svg>
                            <div>
                                Esta venta no tiene productos
                            </div>
                        </div>
                    <?php } ?>

                </form>
            </div>

            <?php
                }
    }
}
?>