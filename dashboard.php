<?php 
include_once __DIR__ . "/funciones.php";
iniciarSession();

if (sanitario($_REQUEST["cerrar"] ?? "")) cierreSession();

if (isset($_SESSION["usuario"])) {
    $usuario = $_SESSION["usuario"];
    $nombreUsuario = $usuario->getNombre();
}

$avisar = sanitario($_REQUEST["avisar"] ?? "");

?>

<!DOCTYPE html>
<?php $title = "DASHBOARD"; ?>
<?php include 'layout/metedatos_css.php'; ?>

<body>
    <?php include 'layout/header.php'; ?>

    <main>

        <!--#ventajamodal -->
        <div id="ventajamodal">
            <div class="modal_cont">
                <a href="#">X</a>
                <h2 id="msg_avizar"><?php echo (isset($nombreUsuario) ? $nombreUsuario . ", " : '') . $avisar; ?>
                </h2>
            </div>
        </div>

        <div class="width90centr">
            <h2>DASHBOARD</h2>
        </div>

        <section>

            <H1>Hola, <?php echo $nombreUsuario ?? "ANANIMUS" ?></H1>

        </section>



    </main>

    <?php include 'layout/footer.php'; ?>


</body>

</html>