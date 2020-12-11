<?php

namespace App\Database;
interface ModeleMongoDBInterface
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

    /**
     * @param $data
     * @return mixed
     */
    public function updateReception($data);

    /**
     * delete a reception
     * @param $id
     * @return int
     */
    public function deleteReception($id) : int;
}
