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
<?php $title = "TECNOLOGÍA"; ?>
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
            <h2>TECNOLOGÍA</h2>
        </div>

        <section>

            <div class="parallax">
                <div class="window">
                </div>
                <div class="width50right">
                    <h2>Amoladora De Ditting Suizo</h2>
                    <p>
                        Utilizamos la amoladora suiza de primera marca EMH64 en algunos de nuestros modelos
                        populares.
                        230V AC y fuente de alimentación 2.75A, tamaño de molienda de 200 ~ 800um. </p>
                    <p>Viene con una velocidad de molienda de 5.40 g / s, una vida útil de molienda de frijol total
                        de
                        1000-1500 kg y la finura puede ser ajustable. El molinillo es más duradero y confiable,
                        proporcionando una potente salida de molienda de frijoles.</p>
                    <p>■ Amoladora de rebabas plana de 64 mm (acero)</p>
                    <p>■ Vida útil: 125.000 veces</p>
                </div>
            </div>

            <div class="fon_paralax">

            </div>

            <div class="parallax2">
                <div class="window">
                </div>
                <div class="width50right">
                    <h2>Amoladora Patentada Jetinno</h2>
                    <p>Hemos diseñado nuestro propio molinillo de frijol patentado de acuerdo con la necesidad real de
                        diseño de diseño de la máquina.</p>
                    <p>Es más adaptable en la organización de una estructura interna de
                        la máquina más ordenada. 230V AC y fuente de alimentación 2.75A, velocidad de molienda de 1.4 ~
                        1.7g / s, vida útil de molienda de frijoles de 500 ~ 1000kg.</p>
                    <p>■ Patente de Jetinno</p>
                    <p>■ Amoladora de rebabas plana de 64 mm</p>
                    <p>■ Vida útil: 62.500 veces</p>
                </div>
            </div>

        </section>


        <iframe src="https://www.youtube.com/embed/icu3Lys3NKU?si=RXNuVVFrBlUWnWpF" title="YouTube video player"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
        </iframe>


    </main>

    <?php include 'layout/footer.php'; ?>


</body>

</html>