<?php

// namespace App;
// use \PDO;
// use \PDOException;

class Connect
{
    static function con()
    {
        try
        {
            $database = new PDO("mysql:host=localhost;dbname=crud","rotsy","GG591337GG");
            $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();

        }
        return $database;
    }
}
?>