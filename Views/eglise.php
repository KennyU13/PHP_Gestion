<nav class="navbar navbar-expand navbar-light bg-white  mb-5  shadow">

<a href="#" class="navbar-brand">CRUD</a>
    
</nav>
<div class="container-fluid">
<div class="row ">

    <div class="col-3">
        <div class="  mb-4">
            <div class="card border-left-primary shadow h-100">
                <div class="card-body">
                    <h4>CREATION D'EGLISE</h4>
                </div>
            </div>
        </div>
        <!-- FORMULAIRE DE creation d'eglise -->
        <div class="  mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <form class="user px-5" method="POST">
                        <div class="form-group text-center">
                            <label>ID EGLISE</label>
                            <input type="text" class="form-control form-control-user <?php if(isset($errorMsg['id']))echo $errorMsg['id']?>" name="idEglise">
                        </div>
                        <div class="form-group text-center">
                            <label>DESIGNATION</label>
                            <input type="text" class="form-control form-control-user <?php if(isset($errorMsg['design']))echo $errorMsg['design']?>" name="designEglise">
                        </div>
                        <p class="text-danger text-center mt-5"><?php if(isset($errorMSG))echo $errorMSG?></p>
                        <p class="text-success text-center mt-5"><?php if(isset($successMsg))echo $successMsg?></p>
                        <button class="btn btn-primary btn-user btn-block" type="submit"
                            name="createEglise">ENREGISTRER</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-9">
        <!-- Listage des eglise -->
       
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">TABLEAUX DES EGLISES</h6>
            </div>
            <div class="card-body minHeight">
                <div class="table-responsive">
                    <table class="table " id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID EGLISE<a href="?page=eglise&sort=ideglise&dir=ASC"><i class="fas fas-font fa-caret-up mx-2"></i></a><a href="?page=eglise&sort=ideglise&dir=DESC"><i class="fas fas-font fa-caret-down"></i></a></th>
                                <th>DESIGNATION<a href="?page=eglise&sort=design&dir=ASC"><i class="fas fas-font fa-caret-up mx-2"></i></a><a href="?page=eglise&sort=design&dir=DESC"><i class="fas fas-font fa-caret-down"></i></a></th>
                                <th>SOLDE<a href="?page=eglise&sort=solde&dir=ASC"><i class="fas fas-font fa-caret-up mx-2"></i></a><a href="?page=eglise&sort=solde&dir=DESC"><i class="fas fas-font fa-caret-down"></i></a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($tableEglise as $x):?>
                            <tr>
                                <td><?=$x['ideglise']?></td>
                                <td><a
                                        href="?page=entre&ideglise=<?=$x['ideglise']?>&eglise=<?=$x['design']?>&solde=<?=$x['solde']?>"><?=$x['design']?></a>
                                </td>
                                <td><?=number_format($x['solde'],0,'',' ')?> Ar</td>
                            </tr>
                            <?php endforeach?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   
</div>