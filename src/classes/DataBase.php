<?php
/**
 * Created by PhpStorm.
 * User: mohmd
 * Date: 02/01/2019
 */

namespace App\classes;

class DataBase
{
    function __construct()
    {

    }

    function connect()
    {
        // Create connection
        $conn = new \mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'), getenv('DB_DATABASE'));
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}