<?php

namespace App\Database;
interface modeleMongoDBInterface
{
    /**
     * List all receptions
     * @return mixed
     */
    public function listReceptions();

    /**
     * add a Reception
     * @param $data
     * @return int
     */
    public function addReception($data): int;

//public function update();

//public function delete();
}
