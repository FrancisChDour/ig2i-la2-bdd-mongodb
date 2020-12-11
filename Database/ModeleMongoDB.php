<?php
namespace App\Database;

use MongoDB\BSON\ObjectId;

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
            $result[] = (array) $reception;
        }

        return $result;
    }

    public function getById($id)
    {
        $reception =  $this->connection->executeQuery("reception", ['_id' => new ObjectId($id)]);

        return (array)$reception[0];
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

    public function updateReception($data) : int
    {
        return $this->connection->update("reception", $data);
    }
}