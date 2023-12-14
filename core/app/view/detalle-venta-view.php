<?php
if (!isset($_SESSION["user_id"])) {
    Core::redir("./");
}


$listaProductos = ProductoData::getproducts();
?>

<div class="table-responsive mx-4">
    <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center m-4">
        <h4> Nueva producto para venta </h4>
    </div>
    <div class="card">
        <div class="card-body">
        <form action="./?action=detalles_venta&opt=add" method="post" id="ventasForm" class="needs-validation" novalidate>

            <div class="mb-3 form-floating">
                <input type="hidden" readonly class="form-control" name="id_venta" id="id_venta" required value = "<?php echo $_GET["id_venta"]?>">
            </div>

            <div class="mb-3">
                <label for="producto_select" class="form-label">Producto</label>
                <select id="producto_select" class="form-select" name="id_producto" onchange="tuFuncion()" required>
                    <option value="0" data-precio=" " selected> Elige un producto </option>
                    <?php
                    foreach ($listaProductos as $key => $prod) {
                        if($prod->stock>0) {
                        ?>
                        <option value="<?php echo $prod->id_producto ?>" data-precio="<?php echo $prod->precio; ?>">
                            <?php echo $prod->nombre ?>
                        </option>
                        <?php
                        }
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

            <div class="mb-3 form-floating text-end">
                <button type="submit" class="btn btn-primary">Agregar producto</button>
            </div>
            </form>
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