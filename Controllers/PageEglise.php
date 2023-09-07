<?php




if(isset($_POST['createEglise']))
{
    $ideglise = htmlspecialchars($_POST['idEglise']);
    $design = htmlspecialchars($_POST['designEglise']);
    if(empty($ideglise) && empty($design))
    {
        $errorMSG="Veuillez completer tous les champs";
        $errorMsg['id']=$errorMsg['design']="is-invalid";
    }
    elseif(empty($ideglise))
    {
        $errorMSG="Veuillez completer le champ ID Eglise";
        $errorMsg['id']="is-invalid";
        
    }
    elseif(empty($design))
    {
        $errorMSG="Veuillez completer le champ Designation";
        $errorMsg['design']="is-invalid";
    }
    else
    {
       
        if($model->insert($ideglise,$design))
        {
            $successMsg="Donneé bien enregistrer";
        }
        else 
        {
            $errorMSG = "Cette model est déjà enregistrer";$errorMSG="Veuillez completer tous les champs";
            $errorMsg['id']=$errorMsg['design']="is-invalid";
        }       
        
    }
}
$tableEglise = $model->list();
$sortable = ["ideglise","design","solde"];
if(!empty($_GET['sort']) && in_array($_GET['sort'],$sortable))
{
    $dir =$_GET['dir'] ?? 'ASC';
    if(!in_array($dir,['ASC','DESC']))
    {
        $dir = "ASC";
    }
    $tableEglise = $model->list($_GET['sort'],$dir);
}
?>