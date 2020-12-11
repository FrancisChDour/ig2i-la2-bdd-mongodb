<?php

namespace App\Controller;
require('../Autoloader.php');

use App\Database\ModeleMongoDB;
use DateTime;
use MongoDB\BSON\ObjectId;
use App\Autoloader;

Autoloader::register();
if (!empty($_POST)) {
    $client = new ModeleMongoDB();
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
        case 'updateReception':
            array_pop($_POST);
            $data = [];
            foreach ($_POST as $key => $datum) {
                $data[$key] = htmlspecialchars($datum);
            }
            $nbInsertedLine = $client->updateReception($data);
            break;
        default:
            break;
    }
    header('Location: ../index.php');
    exit();
}

if (!empty($_GET)) {
    $client = new ModeleMongoDB();
    switch ($_GET['action']) {
        case 'deleteReception':
            $id = new ObjectId($_GET['idReception']);
            $nbDeletedLine = $client->deleteReception($id);
            break;
        default:
            break;
    }
    header('Location: ../index.php');
    exit();
}