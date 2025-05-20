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

<?php
$title = "PRODUCTOS";
include 'layout/metedatos_css.php';
?>

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
            <h2>PRODUCTOS DESTACADOS</h2>
            <?php include 'layout/lista_poductos.php'; ?>
        </div>

        <section>
            <iframe class="misombra" width="760" height="415" src="https://www.youtube.com/embed/icu3Lys3NKU?si=RXNuVVFrBlUWnWpF"
                title="YouTube video player"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
            </iframe>
        </section>

    </main>

    <?php include 'layout/footer.php'; ?>

</body>

</html>