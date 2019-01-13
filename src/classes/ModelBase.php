<?php
/**
 * Created by PhpStorm.
 * User: mohmd
 * Date: 02/01/2019
 */

namespace App\classes;
class ModelBase
{
    public function __construct()
    {
        $db = new DataBase();
        $this->conn = $db->connect();
    }

    /*
     * return all rows
     */
    public function getAll()
    {

        $sql = "SELECT * FROM $this->table";

        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $records = $this->fetch($result);
        } else {
            return false;
        }
        $this->conn->close();

        return $records;
    }

    /*
     * insert new row
     */
    public function insert($row, $value)
    {
        $row = implode(",", $row);
        $value = "'" . implode("', '", $value) . "'";
        $sql = "INSERT INTO $this->table ($row) VALUES ($value)";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }

    /*
     * find rows by column name
     */
    public function where($col, $symbol, $value)
    {
        $sql = "SELECT * FROM $this->table WHERE $col $symbol $value";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $records = $this->fetch($result);
        } else {
            return false;
        }
        $this->conn->close();
        return $records;
    }

     /*
     * delete row by column name
     */
    public function deleteWhere($col, $symbol, $value)
    {
        $sql = "DELETE FROM $this->table WHERE $col $symbol $value";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            $this->conn->close();
            return false;
        }
    }

    /*
     * fetch
     */
    private function fetch($result)
    {
        // output data of each row
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $records[$i] = $row;
            $i++;
        }
        return $records;
    }

}