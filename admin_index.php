<!DOCTYPE html>

<?php $title = "ADMIN_"; ?>
<?php include 'layout/metedatos_css.php'; ?>

<body>

    <?php include 'layout/admin_header.php'; ?>

    <main>

        <div class="width90centr pt-5">

            <div class="col_row_top">

                <a href="admin_agregar.php" class="hover">
                    <div class="caja_vertud">
                        <figure><img src="img/virtud1.png" alt="virtud"></figure>
                        <div>
                            <h3>AGRGAR PRODUCTOS</h3>
                            <p>
                                Agrege los productos a base de datos.
                            </p>
                        </div>
                    </div>
                </a>

                <a href="admin_corregir.php" class="hover">
                    <div class="caja_vertud">
                        <figure><img src="img/virtud2.png" alt="virtud"></figure>
                        <div>
                            <h3>CORREGIR PRODUCTOS</h3>
                            <p>
                                Corrige imagenes, nombres y caracteristicas de los productos.
                            </p>
                        </div>
                    </div>
                </a>

                <a href="#" class="hover">
                    <div class="caja_vertud">
                        <figure><img src="img/virtud3.png" alt="virtud"></figure>
                        <div>
                            <h3>COMING SOON..</h3>
                            <p>
                                Discripcion...
                            </p>
                        </div>
                    </div>
                </a>

            </div>
        </div>

    </main>

    <?php include 'layout/admin_footer.php'; ?>


</body>

</html>