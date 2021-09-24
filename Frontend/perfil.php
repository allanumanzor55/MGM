<?php include_once('validation.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('head.php'); ?>
    <title>Perfil de usuario</title>
</head>

<body id="bg-landing" class="container-fluid px-0">
    <div class="container-fluid bg-opacity min-vh-100 w-100">
        <header>
            <?php include_once('nav.php'); ?>
        </header>
        <div class="row" style="min-height: 8.2vh !important;"></div>
        <main class="row px-5">
            <div class="align-items-start bg-light min-vh-100 pt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="mg-color-1">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Perfil</li>
                    </ol>
                </nav>
                <div class="container-fluid min-vh-100"">
                </div>
            </div>
        </main>
    </div>
    <footer>
        <script src="js/controladores/CRUD.js"></script>
        <script src="js/controladores/login.js"></script>
    </footer>
    <?php include_once('canvas.php'); ?>
</body>

</html>