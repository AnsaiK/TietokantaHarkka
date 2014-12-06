<!--projektin lisäys-->
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="projektin_lisays">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseLisays"
               aria-expanded="true" aria-controls="collapseLisays">Lisää projekti</a>
        </h4>
    </div>
    <div id="collapseLisays" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="projektin_lisays">
        <div class="panel-body">
            <form role="form" action="projektinLisays.php" method="POST">
                <div class="row">
                    <label class="col-xs-6" for="Projekti_nimi">Projektin nimi</label>
                    <label class="col-xs-6" for="Kuvaus">Kuvaus</label>                    
                </div>
                <div class="row">
                    <div class="col-xs-6"><input class="form-control" type="text" name ="lisattavanProjektinNimi" placeholder="Projektin nimi" value="<?php echo htmlspecialchars($data->lisattavanProjektinNimi); ?>"></div>
                    <div class="col-xs-6"><input class="form-control" type="text" name ="lisattavanProjektinKuvaus" placeholder="Kuvaus" value="<?php echo htmlspecialchars($data->lisattavanProjektinKuvaus); ?>"></div>

                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <br>
                        <button type="submit" class="btn btn-default">Lisää projekti</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--projektin lisäys, loppu-->

<!--projektien listaus-->
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">Projektit: <?php echo $data->projektiLkm; ?> kpl</h4>
    </div>
    <div class="panel-body">
        <!-- Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>Projekti</th>
                    <th>Kuvaus</th>
                    <th>Henkilöitä</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>

                <?php foreach ($data->projektitJaLkm as $projektit): ?>
                    <tr>
                        <td><a href="hallinnointi_projektit.php?id=<?php echo $projektit->getProjekti_id(); ?>#headingTiedot"><?php echo htmlspecialchars($projektit->getNimi()); ?></a></td>
                        <td><?php echo htmlspecialchars($projektit->getKuvaus()); ?></td>
                        <td><?php echo $projektit->getHlomaara(); ?></td>
                        <td><div class="btn-group" role="group">
                                <form action="projektinMuokkausjaPoisto.php" method="POST">
                                    <button type="submit" class="btn btn-default btn-sm" name="muokkaa" value="<?php echo $projektit->getProjekti_id(); ?>"><span></span> Muokkaa</button>
                                    <button type="submit" class="btn btn-default btn-sm" name="poista" value="<?php echo $projektit->getProjekti_id(); ?>"><span></span> Poista</button>
                                </form>
                            </div></td>     
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!--projektien listaus, loppu-->

<!--yhden projektin tietojen listaus-->
<?php if (!empty($data->projektinNimi)): ?>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingTiedot">
            <h4 class="panel-title"><?php echo $data->projektinNimi; ?></h4>
        </div>

        <div class="panel-body">
            <?php if (empty($data->projektinSyotteet)): ?>
                Ei merkintöjä
            <?php else: ?>
                <table class="table">
                    <thead>
                    <h5>Osallistujat:</h5>
                    <tr>                        
                        <th>nimi</th>
                        <th>tunnit yhteensä</th>
                        <th>merkintöjen lkm</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data->projektinHloYhteenveto as $hlo): ?>
                            <tr>               
                                <td class="col-xs-3"><?php echo $hlo[1]; ?></td>
                                <td class="col-xs-3"><?php echo $hlo[2]; ?></td>
                                <td class="col-xs-6"><?php echo $hlo[3]; ?></td> 
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td class="col-xs-3"><strong>Henkilöitä : <?php echo $data->projektinHloLkm; ?></strong></td>
                            <td class="col-xs-3"><strong><?php echo $data->projektinTunnit; ?> h</strong></td>
                            <td class="col-xs-6"><strong><?php echo $data->projektinSyoteLkm; ?></strong></td>

                        </tr>
                    </tbody>                   
                </table>


                <table class="table" id ="merkinnat">   
                    <thead>
                    <hr>
                    <h5>Merkinnät:</h5>

                    <tr>                        
                        <th><a href="hallinnointi_projektit.php?id=<?php echo $data->projekti_id; ?>&sort=nimi#merkinnat">nimi <span class ="glyphicon glyphicon-sort-by-alphabet"></span></a></th>
                        <th><a href="hallinnointi_projektit.php?id=<?php echo $data->projekti_id; ?>&sort=kuvaus#merkinnat">työtehtävä <span class ="glyphicon glyphicon-sort-by-alphabet"></span></a></th>
                        <th><a href="hallinnointi_projektit.php?id=<?php echo $data->projekti_id; ?>&sort=paiva#merkinnat">päivä <span class ="glyphicon glyphicon-sort-by-order-alt"></span></a></th>
                        <th><a href="hallinnointi_projektit.php?id=<?php echo $data->projekti_id; ?>&sort=kesto#merkinnat">tunnit <span class ="glyphicon glyphicon-sort-by-order-alt"></span></a></th>
                        <th><a href="hallinnointi_projektit.php?id=<?php echo $data->projekti_id; ?>&sort=lisatiedot#merkinnat">lisätietoja <span class ="glyphicon glyphicon-sort-by-alphabet"></span>   </a></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data->projektinSyotteet as $syote): ?>
                            <tr>               
                                <td class="col-xs-3"><?php echo $syote->getHenkilo_nimi(); ?></td> <!--< <a href="hallinnointi_henkilon_tiedot.php?id=<?php echo $syote->getHenkilo_id(); ?>"-->
                                <td class="col-xs-3"><?php echo $syote->getKuvaus(); ?></td>
                                <td class="col-xs-2"><?php echo $syote->getPaiva(); ?></td>
                                <td class="col-xs-1"><?php echo $syote->getKesto(); ?></td>
                                <td class="col-xs-3"><?php echo $syote->getLisatiedot(); ?></td> 
                            </tr>
                        <?php endforeach; ?>
                    </tbody>                   
                </table>
            <?php endif; ?>
        </div>
    </div>

<?php endif; ?>

<!--yhden projektin tietojen listaus-->
