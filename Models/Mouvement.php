<?php
class Mouvement
{
    private $database;
    private $id;

    public function __construct($id)
    {
        
        $this->database = connect();
        $this->id = $id;
    }
    public function listEntre(string $date1=null, string $date2=null):array
    {
        $entre = array();
        $listDefault = $this->database->prepare('SELECT dateEntre,motif,montantEntre FROM Entre WHERE ideglise = ?');
        $list = $this->database->prepare('SELECT dateEntre , motif,montantEntre  FROM Entre WHERE ideglise = ? AND dateEntre BETWEEN ? AND ?  ');
       
        if($date1 === null && $date2 === null)
        {
            $listDefault->execute(array($this->id));
            while($data=$listDefault->fetch())
            {
                $entre[]=$data;
            }
            
        }
        else
        {
            $list->execute(array($this->id,$date1,$date2));
            while($data=$list->fetch())
            {
                $entre[]=$data;
            }
        }
        return $entre;
    }
    public function listSortie(string $date1=null, string $date2=null):array
    {
        $sortie = array();
        $listDefault = $this->database->prepare('SELECT dateSortie , motif,montantSortie  FROM Sortie WHERE ideglise = ?');
        $list = $this->database->prepare('SELECT dateSortie , motif,montantSortie  FROM Sortie WHERE ideglise = ? AND dateSortie BETWEEN ? AND ?  ');
        if($date1 === null && $date2 === null)
        {
            $listDefault->execute(array($this->id));
            while($data=$listDefault->fetch())
            {
                $sortie[]=$data;
            }
        }
        else
        {
            $list->execute(array($this->id,$date1,$date2));
            while($data=$list->fetch())
            {
                $sortie[]=$data;
            }
        }
        return $sortie;
    }
    public function sommeEntre(string $date1=null, string $date2=null):int
    {
        $selectDefault = $this->database->prepare('SELECT SUM(montantEntre) AS somme FROM Entre WHERE ideglise=?');
        $select = $this->database->prepare('SELECT SUM(montantEntre) AS somme FROM Entre WHERE ideglise = ? AND dateEntre BETWEEN ? AND ?  ');
        if($date1 == null && $date2 == null)
        {
            $selectDefault->execute(array($this->id));
            $somme = $selectDefault->fetch();
        }
        else
        {
            $select->execute(array($this->id,$date1,$date2));
            $somme = $select->fetch();
        }
        return (int)$somme['somme'];
    }
    public function sommeSortie(string $date1=null, string $date2=null):int
    {
        $selectDefault = $this->database->prepare('SELECT SUM(montantSortie) AS somme FROM Sortie WHERE ideglise=?');
        $select = $this->database->prepare('SELECT SUM(montantSortie) AS somme FROM Sortie WHERE ideglise = ? AND dateSortie BETWEEN ? AND ?  ');
        if($date1 == null && $date2 == null)
        {
            $selectDefault->execute(array($this->id));
            $somme = $selectDefault->fetch();
        }
        else
        {
            $select->execute(array($this->id,$date1,$date2));
            $somme = $select->fetch();
        }
        return (int)$somme['somme'];
    }
}
?>