<?php

// namespace App;
// use \Database;


class Sortie
{
    private $database;
    private $date;
    private $id;

    public function __construct($id)
    {
        $x = new DateTime();
        $this->date = $x->format("Y-m-d");
        $this->database = connect();
        $this->id = $id;
    }

    public function list(string $sort = "idsortie",string $dir ="ASC"):array
    {
        $table = array();
        $list = $this->database->prepare('SELECT * FROM Sortie WHERE ideglise =? ORDER BY '.$sort.' '.$dir);
        $list->execute(array($this->id));
        while($data = $list->fetch())
        {
            $table[]=$data;
        }
        return $table;
    }
    public function search(string $motif):array
    {
        $table = array();
        $search = $this->database->prepare('SELECT * FROM Sortie WHERE ideglise = ? AND motif LIKE "%'.$motif.'%"');
        $search->execute(array($this->id));
        while($data = $search->fetch())
        {
            $table[]=$data;
        }
        return $table;
    }

    public function insert(string $motif,int $montant):bool
    {
        

        $insert = $this->database->prepare('INSERT INTO Sortie(ideglise,motif,montantSortie,dateSortie) VALUES(?,?,?,?) ');
        $select = $this->database->prepare('SELECT solde - ? as solde FROM Eglise WHERE ideglise =?');
        $update = $this->database->prepare('UPDATE Eglise SET solde = solde - ? WHERE ideglise= ?');

        $select->execute(array($montant,$this->id));
        $x = $select->fetch();
        $solde =(int) $x['solde'];
        if($solde >= 10000)
        {
            $update->execute(array($montant,$this->id));
            $insert->execute(array($this->id,$motif,$montant,$this->date));
            return true;
        }
        return false;

    }

    public function delete(int $idsortie):bool
    {
        
        $select = $this->database->prepare('SELECT montantSortie From Sortie WHERE idsortie = ?');
        $update = $this->database->prepare('UPDATE Eglise SET solde = solde + ?  WHERE ideglise = ?');
        $delete = $this->database->prepare('DELETE FROM Sortie WHERE idsortie =?');
        
        $select->execute(array($idsortie));
        if($select->rowCount()>0)
        {
            $x =  $select->fetch();
            $montant = (int) $x['montantSortie'];
            $delete->execute(array($idsortie));
            if($delete->rowCount() > 0)
            {
                $update->execute(array($montant,$this->id));
                return true;
            }
        }
        return false;
        
    }
    public function update(string $idsortie,string $motif,string $montant):bool
    {
        $select = $this->database->prepare('SELECT montantSortie FROM Sortie WHERE idsortie = ?');
        $soldeE = $this->database->prepare('SELECT solde+?-? AS solde FROM Eglise WHERE ideglise =?');
        $sumSortie = $this->database->prepare('SELECT SUM(montantSortie) AS montantSortie FROM Sortie WHERE ideglise =?');
        $update1 = $this->database->prepare('UPDATE Sortie SET motif=?,montantSortie=?,dateSortie=? WHERE idsortie = ?');
        $update2 = $this->database->prepare('UPDATE Eglise SET solde =solde+?-? WHERE ideglise =?');
        

        $select->execute(array($idsortie));
        $x = $select->fetch();
        $montantInit=(int)$x['montantSortie'];

        $sumSortie->execute(array($idsortie));
        $y = $sumSortie->fetch();
        $montantSortie=(int)$y['montantSortie'];

        $soldeE->execute(array($montantInit,$montant,$this->id));
        $z = $soldeE->fetch();
        $solde = $z['solde'];
        if($solde >= 10000)
        {
            $update1->execute(array($motif,$montant,$this->date,$idsortie));
            if($update1->rowCount()>0)
            {
                $update2->execute(array($montantInit,$montant,$this->id));
                return true;
            }
        }
        return false;
    }

    

   


 
}

?>