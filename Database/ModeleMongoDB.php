<?php
namespace App\Database;

class modeleMongoDB implements modeleMongoDBInterface {

    protected $connection;

    /**
     * modeleMongoDB constructor.
     */
    public function __construct()
    {
        $this->connection = new connectionMongoDB();
    }

    /**
     * @inheritDoc
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

    /**
     * @inheritDoc
     */
    public function addReception($data) : int
    {
        return $this->connection->insertInto("reception",$data);
    }

    public function deleteReception($id) : int
    {
        return $this->connection->delete("reception",$id);
    }
}