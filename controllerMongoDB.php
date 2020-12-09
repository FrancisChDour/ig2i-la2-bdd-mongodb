<?php
require('modeleMongoDB.php');
if (!empty($_POST)) {
    $client = new modeleMongoDB();
    switch ($_POST['action']) {
        case 'addReception':
            $date = new DateTime();
            $data = array(
                '_id' => new MongoDB\BSON\ObjectId(),
                'id_produit' => $_POST['id_produit'],
                'quantite_recue' => $_POST['quantite_recue'],
                'id_entrepot' => $_POST['id_entrepot'],
                'date' => $date->format('Y-m-d h:i:s')
            );

            $nbInsertedLine = $client->addReception($data);
            break;
        default:
            break;
    }
    header('Location: index.php');
    exit();
}
