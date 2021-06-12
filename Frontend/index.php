<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/landing-styles.css">
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
    <?php include_once('footer.php') ?>
    <script src="js/controladores/CRUD.js"></script>
  </footer>
  <?php include_once('canvas.php');?>
</body>
</html>