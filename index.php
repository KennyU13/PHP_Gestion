<?php
    session_start();
    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT',__DIR__);
    
   

    require ROOT.DS.'Models'.DS.'dbconnect.php';
    $page=["eglise","entre","sortie","mouvement"];
    $page2=["entre","sortie","mouvement"];

    if (!empty($_GET['page']) && is_file('Controllers'.DS.'Page'.ucfirst($_GET['page']).'.php') && in_array($_GET['page'],$page))
    {
       
       
        $name = ucfirst($_GET['page']);
        $file = ROOT.DS.'Models'.DS.$name.'.php';

        require_once $file;

        if(in_array($_GET['page'],$page2))
        {
            require_once ROOT.DS.'Models'.DS.'Eglise.php';
            $eglise = new Eglise();
            include 'Controllers'.DS.'solde.php';
            $model = new $name($_SESSION['ideglise']);
        }
        else
        {
            session_destroy();
            $model = new $name();
        }
        
        include 'Controllers'.DS.'Page'.$name.'.php';
        include ROOT.DS.'Elements'.DS.'header.php';
        if(in_array($_GET['page'],$page2))
        {
            include ROOT.DS.'Elements'.DS.'navbar.php';
        }
        include ROOT.DS.'Views'.DS.$_GET['page'].'.php';
        if($_GET['page']==="mouvement")
        {
            include ROOT.DS.'Elements'.DS.'script.php';
        }
        include ROOT.DS.'Elements'.DS.'footer.php';
    }
    else
    {
        session_destroy();

        require_once ROOT.DS.'Models'.DS.'Eglise.php';
        $model = new Eglise();
        include 'Controllers'.DS.'PageEglise.php';
        include ROOT.DS.'Elements'.DS.'header.php';
        include ROOT.DS.'Views'.DS.'eglise.php';
        include ROOT.DS.'Elements'.DS.'footer.php';
    }
    
?>