<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- jQuery y Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<?php $listaProductos = ProductoData::getproducts(); ?>

<!-- Script de búsqueda -->
<script>
    $(document).ready(function () {
        // Mostrar la lista solo si hay resultados
        function toggleProductList() {
            var isVisible = $("#productInput").val().length > 0 && $(".form-control:visible").length > 0;
            $(".product-list").toggle(isVisible);
        }

        $("#productInput").on("input", function () {
            const searchTerm = $(this).val().toLowerCase();

            // Puedes personalizar el selector según la estructura de tu página
            $(".product-item").each(function () {
                const productText = $(this).text().toLowerCase();
                if (productText.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            // Mostrar/ocultar la lista según los resultados
            toggleProductList();
        });

        // Manejar la selección de la opción
        $(".product-list").on("click", ".product-item", function () {
            var inputProduct = document.getElementById('productInput');
            var inputid = document.getElementById("id_producto");
            inputid.value = $(this).data('id');
            var inputText = document.getElementById("precio");
            inputText.value = $(this).data('precio');

            // Llenar el input con la opción seleccionada
            var textSinEspac = $(this).text();
            textSinEspac = $.trim(textSinEspac); // O puedes usar simplemente: textSinEspac = textSinEspac.trim();
            inputProduct.value = textSinEspac;
            // Ocultar la lista después de seleccionar
            toggleProductList();
        });
    });
</script>

<!-- HTML del formulario y lista de productos -->
<div class="table-responsive mx-4">
    <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center m-4">
        <h4> Nueva producto para venta </h4>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="./?action=detalles_venta&opt=add" method="post" id="ventasForm" class="needs-validation"
                novalidate>

                <div class="mb-3 form-floating">
                    <input type="hidden" readonly class="form-control" name="id_venta" id="id_venta" required
                        value="<?php echo $_GET["id_venta"] ?>">
                </div>

                <div class="mb-3">
                    <label for="producto_select" class="form-label">Producto</label>
                    <input id="productInput" class="form-control" name="nombre" required>
                    <div class="invalid-feedback">Por favor, seleccione un producto.</div>
                </div>


                <!-- Lista de productos -->
                <ul class="list-group product-list" style="display: none;">
                    <?php foreach ($listaProductos as $key => $prod) { ?>
                        <li class="list-group-item product-item" data-precio="<?php echo $prod->precio; ?>" data-id="<?php echo $prod->id_producto; ?>">
                            <?php echo $prod->nombre; ?>
                        </li>
                    <?php } ?>
                </ul>

                <!-- ... Otros campos del formulario ... -->

                <div class="mb-3">
                    <input class="form-control" name="id_producto" id="id_producto" required>
                    <?php $prod->id_producto; ?>
                </div>

                <div class="mb-3 form-floating">
                    <input type="number" readonly class="form-control" name="monto" id="precio" required>
                    <label for="monto">Precio</label>
                    <div class="invalid-feedback">Por favor, complete este campo.</div>
                </div>

                <div class="mb-3 form-floating">
                    <input type="number" class="form-control" name="cantidad" required min="1">
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
