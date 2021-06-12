<?php include_once('validation.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/landing-styles.css">
    <title>Ventas</title>
</head>
    <body id="bg-landing" class="container-fluid px-0">
        <div class="container-fluid bg-opacity min-vh-100 w-100">
        <header>
            <?php include_once('nav.php'); ?>
        </header>
        <div class="row" style="min-height: 8.1vh !important;"></div>
            <main class="row px-5">
                <div class="d-flex align-items-start bg-light min-vh-100 pt-2">
                </div>
            </main>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/controladores/CRUD.js"></script>
    <?php include_once('canvas.php');?>
</body>

</html>