<?php

namespace App\Controller;

use App\Database\modeleMongoDB;
use DateTime;
use MongoDB\BSON\ObjectId;

if (!empty($_POST)) {
    $client = new modeleMongoDB();
    switch ($_POST['action']) {
        case 'addReception':
            $date = new DateTime();
            $data = array(
                '_id' => new ObjectId(),
                'id_produit' => htmlspecialchars($_POST['id_produit']),
                'quantite_recue' => htmlspecialchars($_POST['quantite_recue']),
                'id_entrepot' => htmlspecialchars($_POST['id_entrepot']),
                'date' => $date->format('Y-m-d h:i:s')
            );

            $nbInsertedLine = $client->addReception($data);
            break;
        default:
            break;
    }
    header('Location: ../index.php');
    exit();
}