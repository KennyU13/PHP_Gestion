<?php

// namespace App;
// use \Database;


class Entre
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

    public function list(string $sort = "identre",string $dir ="ASC"):array
    {
        $table = array();
        $list = $this->database->prepare('SELECT * FROM Entre WHERE ideglise =? ORDER BY '.$sort.' '.$dir);
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
        $search = $this->database->prepare('SELECT * FROM Entre WHERE ideglise = ? AND motif LIKE "%'.$motif.'%"');
        $search->execute(array($this->id));
        while($data = $search->fetch())
        {
            $table[]=$data;
        }
        return $table;
    }

    public function insert(string $motif,int $montant):bool
    {
        $insert = $this->database->prepare('INSERT INTO Entre(ideglise,motif,montantEntre,dateEntre) VALUES(?,?,?,?)');
        $update = $this->database->prepare('UPDATE Eglise SET solde = solde + ? WHERE ideglise= ?');
        $insert->execute(array($this->id,$motif,$montant,$this->date));
        if($insert->rowCount()>0)
        {
            $update->execute(array($montant,$this->id));
            return true;
        }
        return false;
    }

    public function delete(int $identre)
    {
        
        $select = $this->database->prepare('SELECT montantEntre From Entre WHERE identre = ?');
        $update = $this->database->prepare('UPDATE Eglise SET solde = solde - ?  WHERE ideglise = ?');
        $delete = $this->database->prepare('DELETE FROM Entre WHERE identre =?');
        
        $select->execute(array($identre));
        if($select->rowCount()>0)
        {
            $x =  $select->fetch();
            $montant = (int) $x['montantEntre'];
            $delete->execute(array($identre));
            if($delete->rowCount()>0)
            {
                $update->execute(array($montant,$this->id));
                
            }
            
        }
    }
    public function update(string $identre,string $motif,string $montant):bool
    {
        $select = $this->database->prepare('SELECT solde from Eglise WHERE ideglise=? AND solde>=10000');
        $selectEntre = $this->database->prepare('SELECT SUM(montantEntre) AS sommeEntre FROM Entre WHERE ideglise=?');
        $selectMontantAct = $this->database->prepare('SELECT montantEntre FROM Entre WHERE ideglise=? AND identre=?');
        $selectSortie = $this->database->prepare('SELECT SUM(montantSortie) AS sommeSortie FROM Sortie WHERE ideglise=?');

        $updateEglise = $this->database->prepare('UPDATE Eglise SET solde= ? WHERE ideglise=?');
        $updateMotif = $this->database->prepare('UPDATE Entre SET motif= ? WHERE identre=?');
        $updateMontant = $this->database->prepare('UPDATE Entre SET motif= ?, montantEntre = ? WHERE identre=?');

        
        $selectEntre->execute(array($this->id));
        $sommeEntre=$selectEntre->fetch();

        $selectSortie->execute(array($this->id));
        $sommeSortie=$selectSortie->fetch();

        $selectMontantAct->execute(array($this->id,$identre));
        $montantAct=$selectMontantAct->fetch();

        //var_dump((int)$sommeEntre['sommeEntre']- (int)$sommeSortie['sommeSortie'] - (int)$montantAct['montantEntre'] +$montant);
        $solde =(int)$sommeEntre['sommeEntre']- (int)$sommeSortie['sommeSortie'] - (int)$montantAct['montantEntre'] +$montant;
        $select->execute(array($this->id));
       
        if($select->rowCount()>0)
        {
            if($solde>=10000)
            {
                $updateEglise->execute(array($solde,$this->id));
                $updateMontant->execute(array($motif,$montant,$identre));
                return true;
            }
            else
            {
                $updateMotif->execute(array($motif,$identre));
                return false;
            }
        }
        else
        {
            $updateEglise->execute(array($solde,$this->id));
            $updateMontant->execute(array($motif,$montant,$identre));
            return true;
        }
        return false; 
    }
    
   
    

   


 
}

?>