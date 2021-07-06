<?php include_once('validation.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once('head.php');?>
  <title>Home</title>
</head>

<body id="bg-landing" class="container-fluid px-0">
  <div class="container-fluid bg-opacity min-vh-100 mx-0 px-0">
    <header>
      <?php include_once('nav.php'); ?>
    </header>
    <main class="row align-items-center vw-100 min-vh-100 m-0 p-0">
      <div class="row" style="height: 15% !important;"></div>
    </main>
  </div>
  <footer>
    <script src="js/controladores/CRUD.js"></script>
  </footer>
  <?php include_once('canvas.php');?>
</body>
</html>