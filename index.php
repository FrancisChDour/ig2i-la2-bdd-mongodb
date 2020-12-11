<?php

namespace App;
require('Autoloader.php');

use App\Database\ModeleMongoDB;

Autoloader::register();

$modele = new ModeleMongoDB();

$collection = $modele->listReceptions();
$columns = array_keys(array_merge(... $collection));
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>LA2 BDD MONGODB</title>
</head>
<body>

<div class="container">
    <h1>LA2 BDD MONGODB</h1>
</div>

<div class="container">
    <h2>Ajouter une réception</h2>
    <form class="form-inline" action="Controller/ControllerMongoDB.php" method="post" name="addReception">
        <div class="form-group mb-2">
            <label for="produit" class="form-label">Produit</label>
            <input type="text" class="form-control" name="id_produit" id="produit" placeholder="Id du produit reçu">
        </div>
        <div class="form-group mb-2">
            <label for="quantite" class="form-label">Quantité</label>
            <input type="text" class="form-control" name="quantite_recue" id="quantite"
                   placeholder="Nombre de produits reçus">
        </div>
        <div class="form-group mb-2">
            <label for="entrepot" class="form-label">Entrepôt</label>
            <input type="text" class="form-control" name="id_entrepot" id="entrepot"
                   placeholder="Entrepôt de réception">
        </div>
        <input type="hidden" name="action" value="addReception">
        <button type="submit" class="btn btn-primary mb-2">Ajouter</button>
    </form>
</div>

<div class="container">
    <h2>Liste des réceptions</h2>
    <table class="table">
        <thead>
        <tr>
            <?php foreach ($columns as $column) { ?>
                <th scope="col"><?php echo $column ?></th>
            <?php } ?>
        </tr>

        </thead>
        <tbody>

        <?php foreach ($collection as $document) {
            $document = (array)$document;
            ?>
            <tr>
                <?php foreach ($columns as $column) { ?>
                    <td><?php if(array_key_exists($column, $document)) echo $document[$column] ?></td>
                <?php } ?>
                <td><a class="btn btn-primary"
                       href="updateReception.php?idReception=<?php echo $document['_id'] ?>" role="button">Modifier</a>
                </td>
                <td><a class="btn btn-danger"
                       href="Controller/ControllerMongoDB.php?action=deleteReception&idReception=<?php echo $document['_id'] ?>"
                       role="button">Supprimer</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
</body>
</html>
