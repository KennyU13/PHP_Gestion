<?php

    $formulaire = array("color"=>"btn-primary","motif"=>"","montant"=>"","name"=>"createEntre","view"=>"ENREGISTRER");
    if(!empty($_GET['ideglise']) && !empty($_GET['motif']))
    {
        $formulaire = array("color"=>"btn-success","motif"=>$_GET['motif'],"montant"=>$_GET['montant'],"name"=>"modifyEntre","view"=>"MODIFIER");
    }
    
    
    // require ROOT.'Models/Autoloader.php';
    // Autoloader::register();
    if(isset($_GET['ideglise']))
    { 
        $_SESSION['ideglise'] = $_GET['ideglise'];
        $_SESSION['eglise'] = $_GET['eglise'];
        
    }
?>