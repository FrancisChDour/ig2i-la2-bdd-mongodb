<?php
namespace App\Database;

class ModeleMongoDB implements ModeleMongoDBInterface {

    protected $connection;

    /**
     * modeleMongoDB constructor.
     */
    public function __construct()
    {
        $this->connection = new ConnectionMongoDB();
    }

    /**
     * @inheritDoc
     */
    public function listReceptions(): array
    {
        $result = [];

        $receptions =  $this->connection->executeQuery("reception");

        foreach ($receptions as $reception) {
            $result[] = (array) $reception;
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