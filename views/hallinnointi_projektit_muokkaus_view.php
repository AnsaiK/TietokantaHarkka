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
                        <div class="col-xs-6"><input class="form-control" type="text" name ="muokattavaNimi" placeholder="Projektin nimi" value="<?php echo htmlspecialchars($data->muokattavaProjekti->getNimi());?>"></div>
                        <div class="col-xs-6"><input class="form-control" type="text" name ="muokattavaKuvaus" placeholder="Kuvaus" value="<?php echo htmlspecialchars($data->muokattavaProjekti->getKuvaus()); ?>"></div>

                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <br>
                            <button type="submit" class="btn btn-default" name="vahvista" value="<?php echo $data->muokattavaProjekti->getProjekti_id();?>">Vahvista muokkaukset</button>
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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Projekti</th>
                    <th>Kuvaus</th>
                    <th>Työntekijöitä</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($data->kaikkiprojektit as $projektit): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($projektit->getNimi()); ?></td>
                        <td><?php echo htmlspecialchars($projektit->getKuvaus()); ?></td>
                        <td>kesken</td>
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
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Projektin tiedot, KESKEN
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <table class="table table-striped">                       
                    <thead>                          
                        <tr>  
                            <th>Henkilö</th>
                            <th>työtehtävä</th>
                            <th>päivä</th>
                            <th>Tunnit</th>
                            <th>lisätietoja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>               
                            <td>Kesken</td>
                            <td>Kesken</td>
                            <td>Kesken</td>
                            <td>Kesken</td>
                            <td></td> 
                        </tr>

                    </tbody>
                </table>
            </div>  
        </div>
    </div>
</div>
<!--yhden projektin tietojen listaus-->
