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

<?php $title = "JETINNO ARGENTINA. Maquinas expendedoras de Cafe"; ?>
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
            <div class="col_row_top">
                <div class="caja_vertud">
                    <figure><img src="img/virtud1.png" alt="virtud"></figure>
                    <div>
                        <h3>VARIEDAD DE BEBIDAS</h3>
                        <p>
                            Posibilidad de preparar más de 20 tipos de bebidas. Modelos con módulos adicionales para
                            refrescos, adición automática de jarabes. Preparación de bebidas con leche viva.
                        </p>
                    </div>
                </div>
                <div class="caja_vertud">
                    <figure><img src="img/virtud2.png" alt="virtud"></figure>
                    <div>
                        <h3>DISEÑO FUNCIONAL</h3>
                        <p>
                            Máquinas de café únicas equipadas con pantallas táctiles. Tienen una apariencia atractiva,
                            una
                            interfaz amigable con la capacidad de reproducir videos y videos de audio. Opciones
                            integradas
                            para seleccionar el idioma del menú.
                        </p>
                    </div>
                </div>
                <div class="caja_vertud">
                    <figure><img src="img/virtud3.png" alt="virtud"></figure>
                    <div>
                        <h3>SISTEMA INTELIGENTE "IOT"</h3>
                        <p>
                            La máquina controla de forma independiente la preparación de bebidas, monitorea el estado,
                            advierte sobre la falta de ingredientes, notifica errores.
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <section class="baner">
            <h2 class="baner_title">ACERCA DE JETINNO ARGENTINA</h2>
            <p class="baner_text">Buen café para inspirar mejor la vida de las personas.</p>
        </section>


        <div class="width90centr">

            <div class="caja_row">
                <figure><img src="img/acerca1.png" alt="acerca"></figure>
                <div>
                    <p>
                        Nacida en 2013, JETINNO es una empresa de equipos inteligentes enfocada en construir máquinas de
                        café comerciales y soluciones que se necesitan para el mercado. Producimos máquinas de café para
                        despliegues vending, HORECA y OCS.
                    </p>
                </div>
            </div>
            <div class="caja_row">
                <figure><img src="img/acerca2.png" alt="acerca"></figure>
                <div>

                    <p>
                        Desde su creación, JETINNO siempre se ha comprometido a convertirse en un fabricante de equipos
                        de café confiable, líder y orientado a la tecnología. A día de hoy, contamos con 2 centros de
                        producción, 4 laboratorios de investigación y 1 centro de I+D.
                    </p>
                </div>
            </div>
            <div class="caja_row">
                <figure><img src="img/acerca3.png" alt="acerca"></figure>
                <div>

                    <p>
                        Nuestras máquinas de café se han instalado en más de 60 regiones y países, como Italia,
                        Dinamarca, España. ahora tenemos 15 clientes importantes en el extranjero, incluidos La-cimbali,
                        Nescafé, Lucking Coffee y Lamanti.
                    </p>
                    <p>
                        JETINNO cree que las tecnologías innovadoras de máquinas de café pueden inspirar una vida mejor.
                    </p>

                </div>
            </div>

        </div>


        <iframe src="https://www.youtube.com/embed/icu3Lys3NKU?si=RXNuVVFrBlUWnWpF" title="YouTube video player"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
        </iframe>


    </main>

    <?php include 'layout/footer.php'; ?>


</body>

</html>