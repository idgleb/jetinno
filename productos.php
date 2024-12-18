<?php
include_once "funciones.php";
?>

<!DOCTYPE html>

<?php
$title = "PRODUCTOS";
include 'layout/metedatos_css.php';
?>

<body>
    <?php include 'layout/header.php'; ?>

    <main>
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