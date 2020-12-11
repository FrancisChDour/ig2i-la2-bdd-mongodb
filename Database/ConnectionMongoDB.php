<?php

namespace App\Database;

use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;
use MongoDB\Driver\BulkWrite;

class ConnectionMongoDB {

    protected $conf;
    protected $manager;

    /**
     * connectionMongoDB constructor.
     * @param string $hostname
     * @param string $database
     */
    public function __construct($hostname = null,$database = null)
    {
        $this->conf = new confMongoDB($hostname,$database);

        if ($hostname !== null) {
            $this->manager = new Manager($hostname);
        } else {
            $this->manager = new Manager($this->conf->getHostname());
        }
    }

    /**
     * @param $table
     * @param array $filter
     * @return array|null
     */
    public function executeQuery($table, $filter = []): array
    {
        $namespace = $this->conf->getDatabase().".".$table;
        $query = new Query($filter);

        try {
        $res = $this->manager->executeQuery($namespace,$query);
        return $res->toArray();
        }
        catch (\MongoDB\Driver\Exception\Exception $e) {
            echo $e->getMessage();
        }
        return [];
    }

    public function insertInto($table,$data)
    {
        $namespace = $this->conf->getDatabase().".".$table;
        $bulk = new BulkWrite;
        $bulk->insert($data);

        $result = $this->manager->executeBulkWrite($namespace, $bulk);
        return $result->getInsertedCount();
    }

    public function delete($table,$id)
    {
        $namespace = $this->conf->getDatabase().".".$table;
        $bulk = new BulkWrite;
        $bulk->delete(['_id' => $id]);

        $result = $this->manager->executeBulkWrite($namespace, $bulk);
        return $result->getDeletedCount();
    }



}
