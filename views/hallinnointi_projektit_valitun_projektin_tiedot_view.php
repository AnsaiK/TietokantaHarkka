<div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingTiedot">
            <h4 class="panel-title"><?php echo $data->projektinNimi; ?></h4>
        </div>

        <div class="panel-body">
            <?php if (empty($data->projektinSyotteet)): ?>
                Ei merkintöjä
            <?php else: ?>

                <!--yhden projektin osallistujien tietojen yhteenvedon listaus-->
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
                                <td class="col-xs-3"><a href="hallinnointi_henkilon_tiedot.php?id=<?php echo $hlo[0]; ?>"><?php echo $hlo[1]; ?></a></td>
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
                <!--yhden projektin osallistujien tietojen yhteenvedon listaus, loppu-->



                <!--valitun projektin kaikkien henkilöiden merkintöjen listaus-->             
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

                <!--valitun projektin kaikkien henkilöiden merkintöjen listaus, loppu-->             
            <?php endif; ?>
        </div>
    </div>