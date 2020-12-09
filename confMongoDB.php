<?php

class confMongoDB {

    protected $hostname;
    protected $database;

    /**
     * confMongoDB constructor.
     * @param string $hostname
     * @param string $database
     */
    public function __construct($hostname = null,$database = null)
    {
        if (!$hostname) {
            $this->hostname = "mongodb://localhost:27017";
        }
        else {
            $this->hostname = $hostname;
        }

        if (!$database) {
            $this->database = "dctime";
        }
        else {
            $this->database = $database;
        }

    }

    /**
     * getHostname
     * @return string
     */
    public function getHostname(): string
    {
        return $this->hostname;
    }

    /**
     * getDatabase
     * @return string
     */
    public function getDatabase(): string
    {
        return $this->database;
    }
}