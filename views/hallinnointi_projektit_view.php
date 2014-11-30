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
                    <div class="col-xs-6"><input class="form-control" type="text" name ="projektinNimi" placeholder="Projektin nimi" value="<?php echo htmlspecialchars($data->uusiProjekti->getNimi()); ?>"></div>
                    <div class="col-xs-6"><input class="form-control" type="text" name ="projektinKuvaus" placeholder="Kuvaus" value="<?php echo htmlspecialchars($data->uusiProjekti->getKuvaus()); ?>"></div>

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
            <h4 class="panel-title"><?php echo $data->projektinNimi; ?> - merkintöjä: <?php echo $data->projektinSyoteLkm; ?></h4>
        </div>
        <div class="panel-body">
            <table class="table ">                       
                <thead>     
                    <?php if (empty($data->projektinSyotteet)): ?>
                        Ei merkintöjä
                    </thead>
                <?php else: ?>
                    <tr>                        
                        <th>Nimi</th>
                        <th>työtehtävä</th>
                        <th>päivä</th>
                        <th>Tunnit</th>
                        <th>lisätietoja</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data->projektinSyotteet as $syote): ?>
                            <tr>               
                                <td><a href="hallinnointi_henkilon_tiedot.php?id=<?php echo $syote->getHenkilo_id(); ?>"><?php echo $syote->getHenkilo_nimi(); ?></a></td>
                                <td><?php echo $syote->getKuvaus(); ?></td>
                                <td><?php echo $syote->getPaiva(); ?></td>
                                <td><?php echo $syote->getKesto(); ?></td>
                                <td><?php echo $syote->getLisatiedot(); ?></td> 
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td>Henkilöitä : <?php echo $data->projektinHloLkm; ?></td>
                            <td>Eri työtehtäviä: <?php echo $data->projektinKuvaustenLkm; ?></td>
                            <td></td>
                            <td><?php echo $data->projektinTunnit; ?> h</td>
                            <td></td>

                        </tr>
                    </tbody>                   
                <?php endif; ?>
            </table>
        </div>
    </div>
<?php endif; ?>

<!--yhden projektin tietojen listaus-->
