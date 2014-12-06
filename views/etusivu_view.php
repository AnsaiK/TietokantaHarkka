 

<!-- Omat projektit -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">Projektisi: <?php echo htmlspecialchars($_SESSION['nimi']) ?></li>
        </h4>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
                <!-- Otsikot -->
                <tr>
                    <th><a href="etusivu.php?sort=nimi">Projekti <span class ="glyphicon glyphicon-sort-by-alphabet"></span></a></th>
                    <th><a href="etusivu.php?sort=kuvaus">Kuvaus <span class ="glyphicon glyphicon-sort-by-alphabet"></span></a></th>
                    <th><a href="etusivu.php?sort=kesto">Tunnit <span class ="glyphicon glyphicon-sort-by-order-alt"></span></a></th>
                    <th> <a href="etusivu.php?sort=lkm">Merkintöjä <span class ="glyphicon glyphicon-sort-by-order-alt"></span></a></th>
                    <th></th>
                </tr>
                <!-- Otsikot loppu -->
            </thead>
            <tbody>
                <!-- Projektin tiedot tietokannasta -->
                <?php foreach ($data->omatprojektit as $omatprojektitiedot): ?>
                    <tr>
                        <td><a href="projekti.php?id=<?php echo $omatprojektitiedot[0]; ?>"><?php echo htmlspecialchars($omatprojektitiedot[1]); ?></a></td>
                        <td><?php echo $omatprojektitiedot[2]; ?></td>
                        <td><?php echo $omatprojektitiedot[3]; ?></td>
                        <td><?php echo $omatprojektitiedot[4]; ?></td>
                        <form action="etusivu.php" method="POST">
                            <td><button type = "submit" name="poistu" class="btn btn-xs btn-default" value="<?php echo $omatprojektitiedot[0]; ?>">Poistu projektista</button></td>
                        </form>   
                    </tr>
            <?php endforeach; ?>
            <!-- Projektin tiedot tietokannasta, loppu -->
            </tbody>
        </table>
    </div> 
</div>
<!-- Omat projektit loppu-->


<!-- Kaikki projektit, joihin ei olla liitytty, collapsible panel-->        
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Liityttävissä olevat projektit</a>
        </div>
        <div id = "collapseOne" class = "panel-collapse collapse in" role = "tabpanel" aria-labelledby = "headingOne">
            <div class = "panel-body">
                <table class = "table">
                    <thead>
                        <!-- Otsikot -->
                        <tr>
                            <th>Projekti</th>
                            <th>Kuvaus</th>
                            <th></th>
                        </tr>
                        <!-- Otsikot loppu -->
                    </thead>
                    <tbody>
                        <!-- projektien tiedot tietokannasta -->
                        <?php foreach ($data->projektit_ei_liitytty as $projektitiedot): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($projektitiedot->getNimi()); ?></td>
                                <td><?php echo htmlspecialchars($projektitiedot->getKuvaus()); ?></td>
                                <form action="etusivu.php" method="POST">
                                    <td><button type = "submit" name="liity" class="btn btn-xs btn-default" value="<?php echo $projektitiedot->getProjekti_id(); ?>">Liity projektiin</button></td>
                                </form>   
                            </tr>
                        <?php endforeach; ?>
                        <!-- projektien tiedot tietokannasta, loppu -->

                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Kaikki projektit, joihin ei olla liitytty loppu, collapsible panel-->        


