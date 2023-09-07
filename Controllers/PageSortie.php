<?php
// use App\Autoloader;
// use App\Eglise;



$formulaire = array("color"=>"btn-primary","motif"=>"","montant"=>"","name"=>"createSortie","view"=>"ENREGISTRER");
if(!empty($_GET['ideglise']) && !empty($_GET['motif']))
{
    $formulaire = array("color"=>"btn-success","motif"=>$_GET['motif'],"montant"=>$_GET['montant'],"name"=>"modifySortie","view"=>"MODIFIER");
}


// require ROOT.'Models/Autoloader.php';
// Autoloader::register();
if(isset($_GET['ideglise']))
{ 
    $_SESSION['ideglise'] = $_GET['ideglise'];
    $_SESSION['eglise'] = $_GET['eglise'];
    
}
$model = new Sortie($_SESSION['ideglise']);
//--------------------------------------------CREATION SORTIE--------------------------------------------------------------------
if(isset($_POST['createSortie']))
{
    $motif = htmlspecialchars($_POST['motifSortie']);
    $montant = $_POST['montantSortie'];
    
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
    }
    else
    {
        if($model->insert($motif,$montant))
        {
            $successMsg="Donnée enregistrer";
        }
        else 
        {
            $errorMSG ="le solde actuel ne doit pas être inférieur à 10.000 Ar";
            $errorMsg['montant']="is-invalid";
        }
        
    }
    $formulaire = array("color"=>"btn-primary","motif"=>"","montant"=>"","name"=>"createSortie","view"=>"ENREGISTRER");
}
//--------------------------------------------MODIFICATION SORTIE--------------------------------------------------------------------

if(isset($_POST['modifySortie']))
{
    $idsortie = (int)$_GET['idsortie'];
    $motif = htmlspecialchars($_POST['motifSortie']);
    $montant = htmlspecialchars($_POST['montantSortie']);
    
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
    }
    else
    {
        if($model->update($idsortie, $motif, $montant))
        {
            $successMsg="Donnée modifier";
        }
        else 
        {
            $errorMSG ="le solde actuel ne doit pas être inférieur à 10.000 Ar";
            $errorMsg['montant']="is-invalid";
        }
    }
    $formulaire = array("color"=>"btn-primary","motif"=>"","montant"=>"","name"=>"createSortie","view"=>"ENREGISTRER");  
}
if($_POST['retour'])
{
    $formulaire = array("color"=>"btn-primary","motif"=>"","montant"=>"","name"=>"createEntre","view"=>"ENREGISTRER");
    $errorMsg['montant']=$errorMsg['motif']="";
}
//--------------------------------------------SUPPRESSION SORTIE--------------------------------------------------------------------
if(!empty($_GET['idsortie'])&& empty($_GET['motif'])&& empty($_GET['montant']))
{
    $model->delete($_GET['idsortie']);
    $successMsg="Donnée supprimer";
    
}

elseif(!empty($_GET['motif'])&& !empty($_GET['montant'])&& !isset($_POST['createSortie'])&& !isset($_POST['retour']))
{
    $formulaire = array("color"=>"btn-success","motif"=>$_GET['motif'],"montant"=>$_GET['montant'],"name"=>"modifySortie","view"=>"MODIFIER");
    $errorMsg['montant']=$errorMsg['motif']="is-valid";
}
$tableSortie = $model->list();//recuperation des valeurs pour le tableau 


//--------------------------------------------RECHERCHE SORTIE--------------------------------------------------------------------

if(isset($_POST['recherche']))
{  
    $motifSearch = htmlspecialchars($_POST['motifSearch']);
    $tableRecherche=$model->search($motifSearch);
    $formulaire = array("color"=>"btn-primary","motif"=>"","montant"=>"","name"=>"createSortie","view"=>"ENREGISTRER");
}
if(isset($_POST['clear']))
{
    $formulaire = array("color"=>"btn-primary","motif"=>"","montant"=>"","name"=>"createSortie","view"=>"ENREGISTRER");
}
//--------------------------------------------ORGANISATION SORTIE--------------------------------------------------------------------
$sortable = ["idsortie","motif","montantSortie","dateSortie"];
if(!empty($_GET['sort']) && in_array($_GET['sort'],$sortable))
{
    $dir =$_GET['dir'] ?? 'ASC';
    if(!in_array($dir,['ASC','DESC']))
    {
        $dir = "ASC";
    }
    $tableSortie = $model->list($_GET['sort'],$dir);
}
$_SESSION['solde'] = $eglise->refreshSolde($_SESSION['ideglise']);//maj solde
include ROOT.'Elements/header.php';
include ROOT.'Elements/navbar.php';
include ROOT.'Views/model.php';
include ROOT.'Elements/footer.php';
?>