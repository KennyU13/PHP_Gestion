<?php

// namespace App;
// use \Database;


class Eglise
{
    private $database;

    public function __construct()
    {
        $this->database = connect();
    }

   

    public function insert(string $ideglise,string $design):bool
    {
        $select = $this->database->prepare('SELECT * FROM Eglise WHERE ideglise= ? OR design = ?');
        $select->execute(array($ideglise,$design));
        if($select->rowCount() == 0)
        {
            $insert = $this->database->prepare('INSERT INTO Eglise(ideglise,design) VALUES (?,?)');
            $insert->execute(array($ideglise,$design));
            return true;
        }
        return false;
    }

    public function list(string $sort = "ideglise",string $dir ="ASC")
    {
        $table = array();
        $list = $this->database->prepare('SELECT * FROM Eglise ORDER BY '.$sort.' '.$dir);
        $list->execute();
        while($data=$list->fetch())
        {
            $table[]=$data;
        }
        return $table;
    }
    public function refreshSolde($ideglise)
    {
        $select = $this->database->prepare('SELECT solde FROM Eglise WHERE ideglise = ?');
        $select->execute(array($ideglise));
        $x=$select->fetch();
        $solde = (int)$x['solde'];
        return $solde;
    } 


 
}

?>