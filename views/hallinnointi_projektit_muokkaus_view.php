<!--projektin muokkaus-->
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default-edit">
        <div class="panel-heading-edit" role="tab" id="projektin_lisays">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseLisays" aria-expanded="true" aria-controls="collapseLisays">
                    Muokkaa projektia
                </a>
            </h4>
        </div>
        <div id="collapseLisays" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="projektin_lisays">
            <div class="panel-body">
                <form role="form" action="projektinMuokkausjaPoisto.php" method="POST">
                    <div class="row">
                        <label class="col-xs-6" for="Projekti_nimi">Projektin nimi</label>
                        <label class="col-xs-6" for="Kuvaus">Kuvaus</label>                    
                    </div>
                    <div class="row">
                        <div class="col-xs-6"><input class="form-control" type="text" name ="muokattavaNimi" placeholder="Projektin nimi" value="<?php echo htmlspecialchars($data->muokattavaProjektiNimi);?>"></div>
                        <div class="col-xs-6"><input class="form-control" type="text" name ="muokattavaKuvaus" placeholder="Kuvaus" value="<?php echo htmlspecialchars($data->muokattavaProjektiKuvaus); ?>"></div>

                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <br>
                            <button type="submit" class="btn btn-default" name="vahvista" value="<?php echo $data->muokattavaProjektiId;?>">Vahvista muokkaukset</button>
                            <a href="hallinnointi_projektit.php" button type="submit" class="btn btn-default" name="peruuta">Peruuta</a>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!--projektin muokkaus, loppu-->

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
            <table class="table ">                       
                <thead>                          
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
                            <td><?php echo $syote->getHenkilo_nimi(); ?></td>
                            <td><?php echo $syote->getKuvaus(); ?></td>
                            <td><?php echo $syote->getPaiva(); ?></td>
                            <td><?php echo $syote->getKesto(); ?></td>
                            <td><?php echo $syote->getLisatiedot(); ?></td> 
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>
<!--yhden projektin tietojen listaus-->
