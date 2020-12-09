<?php

require("connectionMongoDB.php");

class modeleMongoDB {

    protected $connection;

    /**
     * modeleMongoDB constructor.
     */
    public function __construct()
    {
        $this->connection = new connectionMongoDB();
    }

    /**
     * Normalize all receptions and list them in an array
     * @return array
     */
    public function listReceptions(): array
    {
        $result = [];

        $receptions =  $this->connection->executeQuery("reception");

        foreach ($receptions as $reception) {
            $result[] = [
              "idReception" => $reception->_id,
              "idProduit" => $reception->id_produit,
              "idEntrepot" => $reception->id_entrepot,
              "quantite" => $reception->quantite_recue,
              "date" => $reception->date,
            ];
        }

        return $result;
    }

    public function addReception($data)
    {
        return $this->connection->insertInto("reception",$data);
    }
}