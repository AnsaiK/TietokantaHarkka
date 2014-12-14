<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTiedot">
        <h4 class="panel-title"><?php echo htmlspecialchars($data->projektinNimi); ?></h4>
    </div>

    <div class="panel-body">
        <?php if (empty($data->projektinHloYhteenveto)): ?>
            Ei osallistujia
        <?php else: ?>

            <!--yhden projektin osallistujien tietojen yhteenvedon listaus-->
            <table class="table">
                <thead>
                <h5>Osallistujat:</h5>
                <tr>   
                    <th>nimi</th>
                    <th>tunnit yhteensä</th>
                    <th>merkintöjen lkm</th>
                    <th>suodata nimellä</th>

                </tr>
                </thead>
                <tbody>
                    <!--henkilöittäin filtteröinnin checkbox sekä projektin henkilöt ja heidän tietojen yhteenveto. Array[0] = hlo_id, Array[1] = nimi, Array[2] = tunnit yhteensä, Array[3] = merkintöjen lkm-->
                    <?php foreach ($data->projektinHloYhteenveto as $hlo): ?>
                        <tr>  

                            <td class="col-xs-2"><a href="hallinnointi_henkilon_tiedot.php?id=<?php echo $hlo[0]; ?>"><?php echo htmlspecialchars($hlo[1]); ?></a></td>
                            <td class="col-xs-3"><?php echo $hlo[2]; ?></td>
                            <td class="col-xs-5"><?php echo $hlo[3]; ?></td> 
                            <td class="col-xs-2"><input type="checkbox" name="redirect" value="hallinnointi_projektit.php?id=<?php echo $data->projekti_id; ?>&filter=<?php echo $hlo[0]; ?>#merkinnat" 
                                                        <?php if ($hlo[0] == $data->filtteriHlo): ?> checked="checked"<?php endif; ?>
                                                        ></td>            
                        </tr>
                    <?php endforeach; ?>

                    <!--henkilöiden tietojen yhteenveto-->
                    <tr>
                        <td class="col-xs-2"><strong>Kaikki Henkilöt: <?php echo $data->projektinHloLkm; ?> kpl</strong></td>
                        <td class="col-xs-3"><strong><?php echo $data->projektinTunnit; ?> h</strong></td>
                        <td class="col-xs-5"><strong><?php echo $data->projektinSyoteLkm; ?></strong></td>
                        <td class="col-xs-2"><input type="checkbox" name="redirect" value="hallinnointi_projektit.php?id=<?php echo $data->projekti_id; ?>#merkinnat" <?php if (empty($data->filtteriHlo)): ?> checked="checked"<?php endif; ?>></td>

                    </tr>

                    <!--henkilöittäin filtteröinnin checkboxin scripti-->
                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
                <script>
                    $('input[type="checkbox"]').on('click', function () {
                        window.location = $(this).val();
                    });
                </script>
                </tbody>                   
            </table>
            <!--yhden projektin osallistujien tietojen yhteenvedon listaus, loppu-->




            <!--valitun projektin kaikkien henkilöiden merkintöjen listaus-->             
            <table class="table" id ="merkinnat">  
                <thead>
                <hr>
                <h5>Merkinnät:</h5> 

                <?php if (empty($data->projektinSyotteet)): ?>
                    Ei merkintöjä 
                    </thead>
                <?php else: ?>
                    <tr>                        
                        <th><a href="hallinnointi_projektit.php?id=<?php echo $data->projekti_id; ?>&sort=nimi&filter=<?php echo $data->filtteriHlo; ?>#merkinnat">nimi <span class ="glyphicon glyphicon-sort-by-alphabet"></span></a></th>
                        <th><a href="hallinnointi_projektit.php?id=<?php echo $data->projekti_id; ?>&sort=kuvaus&filter=<?php echo $data->filtteriHlo; ?>#merkinnat">työtehtävä <span class ="glyphicon glyphicon-sort-by-alphabet"></span></a></th>
                        <th><a href="hallinnointi_projektit.php?id=<?php echo $data->projekti_id; ?>&sort=paiva&filter=<?php echo $data->filtteriHlo; ?>#merkinnat">päivä <span class ="glyphicon glyphicon-sort-by-order-alt"></span></a></th>
                        <th><a href="hallinnointi_projektit.php?id=<?php echo $data->projekti_id; ?>&sort=kesto&filter=<?php echo $data->filtteriHlo; ?>#merkinnat">tunnit <span class ="glyphicon glyphicon-sort-by-order-alt"></span></a></th>
                        <th><a href="hallinnointi_projektit.php?id=<?php echo $data->projekti_id; ?>&sort=lisatiedot&filter=<?php echo $data->filtteriHlo; ?>#merkinnat">lisätietoja <span class ="glyphicon glyphicon-sort-by-alphabet"></span>   </a></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data->projektinSyotteet as $syote): ?>
                            <tr>               
                                <td class="col-xs-3"><?php echo htmlspecialchars($syote->getHenkilo_nimi()); ?></td>
                                <td class="col-xs-3"><?php echo htmlspecialchars($syote->getKuvaus()); ?></td>
                                <td class="col-xs-2"><?php echo $syote->getPaiva(); ?></td>
                                <td class="col-xs-1"><?php echo $syote->getKesto(); ?></td>
                                <td class="col-xs-3"><?php echo htmlspecialchars($syote->getLisatiedot()); ?></td> 
                            </tr>
                        <?php endforeach; ?>
                    </tbody>    
                <?php endif; ?>
            </table>
            <!--valitun projektin kaikkien henkilöiden merkintöjen listaus, loppu-->             
        <?php endif; ?>
    </div>
</div>