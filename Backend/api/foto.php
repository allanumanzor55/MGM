<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include_once('../class/class-fotografia.php');
    //header('Content-type: image/jpg');
    $foto = Fotografia::obtenerFoto($_GET['id']); 
    echo '<img class="img-fluid" src="data:image/jpg;base64, '.$foto.'"/>';
    ?>
</body>
</html>
