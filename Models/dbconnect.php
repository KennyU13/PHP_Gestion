<?php
function connect()
{
    try
        {
            $database = new PDO("mysql:host=localhost;dbname=crud","kenny","kenny");
            $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();

        }
        return $database;
}
?>