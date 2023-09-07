<div class="  mb-4">
    <div class="card  shadow ">
        <div class="card-body py-3">
            <div class="row mt-3">
                <div class="col-6 ">
                    <h4>LISTE DES MOUVEMENTS DES CAISSES</h4>
                </div>
                <form class="user px-5 row col-6 d-flex d-block" method="POST">

                    <div class="col-3"></div>
                    <input type="date" class="col-3 form-control  text-center mx-2" value="<?=date('Y-m-d')?>"
                        name="date1">
                    <input type="date" class="col-3 form-control text-center " name="date2" value="<?=date('Y-m-d')?>">
                    <button class="col-1 btn btn-primary btn-block mx-2 " type="submit" name="mouvement"><i
                            class="fas fa-search"></i></button>
                    <button class="col-1 btn btn-primary btn-block mt-0 " type="submit" name="generate"><i
                            class="fas fa-download"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">

    <div class="col-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <?php if(isset($date1))  echo 'Mouvement d’entrée en caisse : entre '.$date1.' et '.$date2; else echo 'Mouvement des entrées';?>
                </h6>
            </div>
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Date d'entrée</th>
                                <th>Motif</th>
                                <th>Montant</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($tableEntre as $x):?>
                            <tr>
                                <td><?=$x['dateEntre']?></td>
                                <td><?=$x['motif']?></td>
                                <td><?=number_format($x['montantEntre'],0,'',' ')?> Ar</td>
                            </tr>
                            <?php endforeach?>
                        </tbody>
                    </table>
                    <div>Total montant entrant : <?=number_format($sommeEntre,0,'',' ')?> Ar</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <?php if(isset($date1))  echo 'Mouvement de sortie de caisse : entre '.$date1.' et '.$date2; else echo 'Mouvement des sorties';?>
                </h6>
            </div>
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Date de sortie</th>
                                <th>Motif</th>
                                <th>Montant</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($tableSortie as $x):?>
                            <tr>
                                <td><?=$x['dateSortie']?></td>
                                <td><?=$x['motif']?></td>
                                <td><?=number_format($x['montantSortie'],0,'',' ')?> Ar</td>
                            </tr>
                            <?php endforeach?>
                        </tbody>
                    </table>
                    <div>Total montant sortant : <?=number_format($sommeSortie,0,'',' ')?> Ar</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="  mb-4">
    <div class="card text-center shadow h-100 ">
        <div class="card-body">
            <h4>HISTOGRAMME DES MOUVEMENTS </h4>
        </div>
    </div>
</div>
<div class="row">
    <?php if(isset($date1)):?>
    <div class="col-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Histogramme entre : <?=$date1?> et <?=$date2?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">

                <p><span style="font-size:20px;color:#4e73df;"><i class="fas fa-square"></i></span> Entrée:
                    <?=number_format($sommeEntre,0,'',' ')?> Ar</p>


                <div class="chart-pie pt-4">
                    <canvas id="myPieChart"></canvas>
                </div>
                <p><span style="font-size:20px;color:#1cc88a;"><i class="fas fa-square"></i></span> Sortie:
                    <?=number_format($sommeSortie,0,'',' ')?> Ar</p>

            </div>
        </div>
    </div>
    <?php endif?>
    <div class="col-6">
        <div class="card shadow mb-4 ">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Histogramme durant une année</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p><span style="font-size:20px;color:#4e73df;"><i class="fas fa-square"></i></span> Entrée:
                    <?=number_format($sommeE,0,'',' ')?> Ar</p>
                <div class="chart-pie pt-4">
                    <canvas id="myPieChart2"></canvas>
                </div>
                <p><span style="font-size:20px;color:#1cc88a;"><i class="fas fa-square"></i></span> Sortie:
                    <?=number_format($sommeS,0,'',' ')?> Ar</p>

            </div>
        </div>
    </div>
</div>
</div>