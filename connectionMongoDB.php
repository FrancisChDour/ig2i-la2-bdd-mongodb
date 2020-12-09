<?php

require("confMongoDB.php");

class connectionMongoDB {

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
            $this->manager = new MongoDB\Driver\Manager($hostname);
        } else {
            $this->manager = new MongoDB\Driver\Manager($this->conf->getHostname());
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
        $query = new MongoDB\Driver\Query($filter);

        try {
        $res = $this->manager->executeQuery($namespace,$query);
        return $res->toArray();
        }
        catch (\MongoDB\Driver\Exception\Exception $e) {
            echo $e->getMessage();
        }
        return null;
    }

    public function insertInto($table,$data)
    {
        $namespace = $this->conf->getDatabase().".".$table;
        $bulk = new MongoDB\Driver\BulkWrite;
        $id = $bulk->insert($data);

        $result = $this->manager->executeBulkWrite($namespace, $bulk);
        return $result->getInsertedCount();
    }

}
