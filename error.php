<?php
include_once __DIR__ . "/funciones.php";
iniciarSession();

$error = sanitario($_REQUEST["error"]??"");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body>
    <main>

        <div class="width90centr">

            <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
                <div class="text-center">
                    <h1 class="display-1 fw-bold text-danger">CHE, COMO TE VA? </h1>
                    <p class="fs-3"><span class="text-danger">Oops!</span> <?php echo $error ?></p>
                    <img src="img/error.jpg" alt="Funny error image" class="mb-4 w-25 h-30 rounded-5">
                    <p class="lead">Creo que no tenes suerte!</p>
                    <a href="index.php" class="btn btn-primary">INICIO</a>
                </div>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    </main>




</body>

</html>