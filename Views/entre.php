<div class="  mb-4">
    <div class="card text-center shadow h-100 ">
        <div class="card-body">
            <h4>LISTE DES ENTREES</h4>
        </div>
    </div>
</div>
<div class="row">

    <div class="col-3">
        <div class="  mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Eglise
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$_SESSION['eglise']?></div>
                        </div>
                        <div class="col-auto">
                            Solde : <?=number_format($_SESSION['solde'],0,'',' ')?> Ar
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FORMULAIRE DE creation d'entrée -->
        <div class="  mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <form class="user px-5 text-center" method="POST">
                        <?php if($formulaire['color']==="btn-success"):?> <p class="mb-4">ID à modifier =
                            <?=$_GET['identre']?></p><?php endif?>
                        <div class="form-group text-center has-error">
                            <label>MOTIF</label>
                            <input type="text"
                                class="form-control form-control-user  <?php if(isset($errorMsg['motif']))echo $errorMsg['motif']?> text-center"
                                name="motifEntre" value="<?=$formulaire['motif']?>">
                        </div>
                        <div class="form-group text-center">
                            <label>MONTANT</label>
                            <input type="number"
                                class="form-control form-control-user  <?php if(isset($errorMsg['montant']))echo $errorMsg['montant']?>  text-center"
                                name="montantEntre" value="<?=$formulaire['montant']?>">
                        </div>
                        <p class="text-danger text-center mt-5"><?php if(isset($errorMSG))echo $errorMSG?></p>
                        <p class="text-success text-center mt-5"><?php if(isset($successMsg))echo $successMsg?></p>
                        <div class="row">
                            <?php if($formulaire['color']==="btn-success"):$col ='col-9';?>
                            <button class="btn btn-success btn-user  col-2" type="submit" name="retour"><i
                                    class="fas fa-arrow-left"></i></button>
                            <div class="col"></div>
                            <?php endif?>

                            <button class="btn <?=$col?> m-0 <?= $formulaire['color']?> btn-user btn-block"
                                type="submit" name="<?=$formulaire['name']?>"><?=$formulaire['view']?></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-9">
        <!-- Listage des entres -->

        <div class="card shadow mb-4">
            <div class="card-header py-3 ">
                <div class="row">
                    <div class="col">
                        <h6 class="m-0 font-weight-bold text-primary col-6">TABLEAUX DES ENTREES</h6>
                    </div>
                    <form class="form-user row col-6 d-flex d-block" method="POST">
                        <input type="text" class="form-control col-9 form-control-user "
                            placeholder="placez le motif à chercher ..." name="motifSearch">
                        <button class="btn btn-primary btn-user btn-block btn-sm col-1 ml-2" type="submit"
                            name="recherche"><i class="fas fa-search"></i></button>
                        <button class="btn btn-primary btn-user btn-block btn-sm col-1 ml-2 mt-0 " type="submit"
                            name="clear"><i class="fas fa-redo"></i></button>

                    </form>
                </div>

            </div>
            <div class="card-body minHeight">
                <div class="table-responsive">
                    <table class="table " id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID ENTRE <?php if(empty($tableRecherche)):?><a
                                        href="?page=entre&sort=identre&dir=ASC"><i
                                            class="fas fas-font fa-caret-up mx-2"></i></a><a
                                        href="?page=entre&sort=identre&dir=DESC"><i
                                            class="fas fas-font fa-caret-down"></i></a><?php endif?></th>
                                <th>MOTIF<?php if(empty($tableRecherche)):?><a href="?page=entre&sort=motif&dir=ASC"><i
                                            class="fas fas-font fa-caret-up mx-2"></i></a><a
                                        href="?page=entre&sort=motif&dir=DESC"><i
                                            class="fas fas-font fa-caret-down"></i></a><?php endif?></th>
                                <th>MONTANT<?php if(empty($tableRecherche)):?><a
                                        href="?page=entre&sort=montantEntre&dir=ASC"><i
                                            class="fas fas-font fa-caret-up mx-2"></i></a><a
                                        href="?page=entre&sort=montantEntre&dir=DESC"><i
                                            class="fas fas-font fa-caret-down"></i><?php endif?></a></th>
                                <th>DATE D'ENTREE<?php if(empty($tableRecherche)):?><a
                                        href="?page=entre&sort=dateEntre&dir=ASC"><i
                                            class="fas fas-font fa-caret-up mx-2"></i></a><a
                                        href="?page=entre&sort=dateEntre&dir=DESC"><i
                                            class="fas fas-font fa-caret-down"></i><?php endif?></a></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($tableRecherche)):foreach($tableRecherche as $x):?>
                            <tr>
                                <td><?=$x['identre']?></td>
                                <td><?=$x['motif']?></td>
                                <td><?=number_format($x['montantEntre'],0,'',' ')?> Ar</td>
                                <td><?=$x['dateEntre']?></td>
                                <td><a href="?page=entre&identre=<?=$x['identre']?>&motif=<?=$x['motif']?>&montant=<?=$x['montantEntre']?>"
                                        class="btn btn-primary btn-circle mr-4 btn-sm "><i
                                            class="fas fa-pencil-alt"></i></a><a id="supprimer"
                                        href="?page=entre" onclick="deleteEntre(<?=$x['identre']?>)""
                                        class="btn btn-danger btn-circle btn-sm "><i class="fas fa-trash"></i></a></td>
                            </tr>
                            <?php endforeach; else:foreach($tableEntre as $x):?>
                            <tr>
                                <td><?=$x['identre']?></td>
                                <td><?=$x['motif']?></td>
                                <td><?=number_format($x['montantEntre'],0,'',' ')?> Ar</td>
                                <td><?=$x['dateEntre']?></td>
                                <td><a href="?page=entre&identre=<?=$x['identre']?>&motif=<?=$x['motif']?>&montant=<?=$x['montantEntre']?>"
                                        class="btn btn-primary btn-circle mr-4 btn-sm "><i
                                            class="fas fa-pencil-alt"></i></a><a id="supprimer"
                                        href="?page=entre" onclick="deleteEntre(<?=$x['identre']?>)" 
                                        class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a></td>
                            </tr>
                            
                            <?php endforeach; endif?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>