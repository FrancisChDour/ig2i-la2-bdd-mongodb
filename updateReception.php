<?php

namespace App;
require('Utils/Autoloader.php');

use App\Database\modeleMongoDB;
use App\Utils\Autoloader;
Autoloader::register();

$modele = new modeleMongoDB();

$collection = $modele->listReceptions();
$columns = array_keys(array_merge(... $collection));

$currentReception = $modele->getById($_GET['idReception']);
//var_dump($currentReception);die;
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>

<div class="container">
    <h1>LA2 BDD MONGODB</h1>
</div>

<div class="container">
    <h2>Modifier réception</h2>
    <form class="form-inline" action="Controller/ControllerMongoDB.php" method="post" name="updateReception">
        <?php foreach ($columns as $column) { ?>
        <div class="form-group mb-2">
            <label for="<?php echo $column ?> " class="form-label"><?php echo $column ?></label>
            <input type="text" class="form-control" name="<?php echo $column ?>" id="<?php echo $column ?>"
                    <?php if('_id' == $column) echo "readonly" ?>
                    value="<?php if(array_key_exists($column, $currentReception)) echo $currentReception[$column] ?>">
        </div>
        <?php } ?>
        <input type="hidden" name="action" value="updateReception">
        <button type="submit" class="btn btn-primary">Modifier</button>
        <a class="btn btn-primary" href="index.php" role="button">Annuler</a>
    </form>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
