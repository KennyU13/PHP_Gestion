<?php
// use App\Autoloader;
// use App\Eglise;


//--------------------------------------------CREATION ENTRE--------------------------------------------------------------------
if(isset($_POST['createEntre']))
{
    $motif = htmlspecialchars($_POST['motifEntre']);
    $montant = htmlspecialchars($_POST['montantEntre']);
    
    
    if(empty($motif) && empty($montant))
    {
        $errorMSG="Veuillez completer tous les champs";
        $errorMsg['montant']=$errorMsg['motif']="is-invalid";
    }
    elseif(empty($motif))
    {
        $errorMSG="Veuillez completer le champ motif";
        $errorMsg['motif']="is-invalid";
    }
    elseif(empty($montant))
    {
        $errorMSG="Veuillez completer le champ montant";
        $errorMsg['montant']="is-invalid";
    }
    elseif($montant < 0)
    {
        $errorMSG="Le montant saisie doit être supérieur à 0 Ar";
        $errorMsg['montant']="is-invalid";
    }else
    {
        if($model->insert($motif,$montant))
        {
            $successMsg="Donnée enregistrer";
        }
    }
 
}
//--------------------------------------------MODIFICATION ENTRE--------------------------------------------------------------------
if(isset($_POST['modifyEntre']))
{
    $identre = (int)$_GET['identre'];
    $motif = htmlspecialchars($_POST['motifEntre']);
    $montant = htmlspecialchars($_POST['montantEntre']);
    
    if(empty($motif) && empty($montant) )
    {
        $errorMSG="Veuillez completer tous les champs";
        $errorMsg['montant']=$errorMsg['motif']="is-invalid";
    }
    elseif(empty($motif))
    {
        $errorMSG="Veuillez completer le champ motif";
        $errorMsg['motif']="is-invalid";
    }
    elseif(empty($montant))
    {
        $errorMSG="Veuillez completer le champ montant";
        $errorMsg['montant']="is-invalid";
    }
    elseif($montant < 0)
    {
        $errorMSG="Le montant saisie doit être supérieur à 0 Ar";
        $errorMsg['montant']="is-invalid";
    }
    else
    {
        if($model->update($identre, $motif, $montant))
        {
            $successMsg="Donnée modifier";
        }
        else
        {
            $errorMSG="Le solde actuel ne doit pas être inférieur à 10.000Ar";
            $errorMsg['montant']="is-invalid";
        }
        $formulaire = array("color"=>"btn-success","motif"=>"","montant"=>"","name"=>"modifyEntre","view"=>"MODIFIER");
    }
   
}
if(isset($_POST['retour']))
{
    $formulaire = array("color"=>"btn-primary","motif"=>"","montant"=>"","name"=>"createEntre","view"=>"ENREGISTRER");
    $errorMsg['montant']=$errorMsg['motif']="";
}

//--------------------------------------------SUPRESSION ENTRE--------------------------------------------------------------------
if(!empty($_GET['identre'])&& empty($_GET['motif'])&& empty($_GET['montant']) )
{
    $model->delete($_GET['identre']);
    $successMsg="Donnée supprimer";
    
}
elseif(!empty($_GET['motif'])&& !empty($_GET['montant']) && !isset($_POST['createEntre'])&& !isset($_POST['retour']))
{
    $formulaire = array("color"=>"btn-success","motif"=>$_GET['motif'],"montant"=>$_GET['montant'],"name"=>"modifyEntre","view"=>"MODIFIER");
    $errorMsg['montant']=$errorMsg['motif']="is-valid";
}




$tableEntre = $model->list();//recuperation des valeurs pour le tableau

$_SESSION['solde'] = $eglise->refreshSolde($_SESSION['ideglise']);//maj solde
//--------------------------------------------RECHERCHE ENTRE--------------------------------------------------------------------
if(isset($_POST['recherche']))
{  
    $motifSearch = htmlspecialchars($_POST['motifSearch']);
    $tableRecherche=$model->search($motifSearch);
    $formulaire = array("color"=>"btn-primary","motif"=>"","montant"=>"","name"=>"createEntre","view"=>"ENREGISTRER");
    $errorMsg['montant']=$errorMsg['motif']="";
}
if(isset($_POST['clear']))
{
    $formulaire = array("color"=>"btn-primary","motif"=>"","montant"=>"","name"=>"createEntre","view"=>"ENREGISTRER");
    
}
//--------------------------------------------ORGANISATION ENTRE--------------------------------------------------------------------
$sortable = ["identre","motif","montantEntre","dateEntre"];
if(!empty($_GET['sort']) && in_array($_GET['sort'],$sortable))
{
    $dir =$_GET['dir'] ?? 'ASC';
    if(!in_array($dir,['ASC','DESC']))
    {
        $dir = "ASC";
    }
    $tableEntre = $model->list($_GET['sort'],$dir);
}




?>