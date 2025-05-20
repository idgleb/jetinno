<?php
include_once __DIR__ . "/funciones.php";
iniciarSession();

if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
    $nombreUsuario = $usuario->getNombre();
    $rolUsuario = $usuario->getRol();
}

if (!isset($rolUsuario)) {
    header("Location: index.php?avisar=" . urlencode("No tenes derecho") . "#ventajamodal");
    exit;
}
if ($rolUsuario != "admin") {
    header("Location: index.php?avisar=" . urlencode("No tenes derecho") . "#ventajamodal");
    exit;
}

$avisar = sanitario($_REQUEST["avisar"] ?? "");

?>


<!DOCTYPE html>
<?php $title = "ADMIN_"; ?>
<?php include 'layout/metedatos_css.php'; ?>

<body>

    <?php include 'layout/admin_header.php'; ?>

    <main>

        <!--#ventajamodal -->
        <div id="ventajamodal">
            <div class="modal_cont">
                <a href="#">X</a>
                <h2 id="msg_avizar"><?php echo (isset($nombreUsuario) ? $nombreUsuario . ", " : '') . $avisar; ?>
                </h2>
            </div>
        </div>

        <div class="width90centr pt-5">

            <div class="col_row_top">

                <a href="admin_agregar.php" class="hover">
                    <div class="caja_vertud">
                        <figure><img src="img/virtud1.png" alt="virtud"></figure>
                        <div>
                            <h3>AGRGAR PRODUCTOS</h3>
                            <p>
                                Agrege los productos a base de datos, con visualizacion abajo
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

                <a href="admin_usuarios.php" class="hover">
                    <div class="caja_vertud">
                        <figure><img src="img/virtud3.png" alt="virtud"></figure>
                        <div>
                            <h3>USUARIOS</h3>
                            <p>
                                Corrije los datos de usuarios, asigna o elemina el rol ADMIN
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