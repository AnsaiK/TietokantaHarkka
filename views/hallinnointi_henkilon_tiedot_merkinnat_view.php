<div class="panel panel-default">
    <div class="panel-heading" id="tiedot">
        <h4 class="panel-title">Merkinnät: <?php echo $data->projektinNimi; ?></h4></div>
    <div class="panel-body">
        <table class="table">    
            <?php if (!empty($data->henkilonTyosyotteet)): ?>
                <thead> 
                    <tr>   
                        <th><a href="hallinnointi_henkilon_tiedot.php?id=<?php echo $data->henkilo->getHenkilo_id() ?>&sort=nimi&filter=<?php echo $data->filtteriProjekti; ?>#tiedot">Projekti <span class ="glyphicon glyphicon-sort-by-alphabet"></span></a></th>
                        <th><a href="hallinnointi_henkilon_tiedot.php?id=<?php echo $data->henkilo->getHenkilo_id() ?>&sort=kuvaus&filter=<?php echo $data->filtteriProjekti; ?>#tiedot">Työtehtävä <span class ="glyphicon glyphicon-sort-by-alphabet"></span></th>
                        <th><a href="hallinnointi_henkilon_tiedot.php?id=<?php echo $data->henkilo->getHenkilo_id() ?>&sort=paiva&filter=<?php echo $data->filtteriProjekti; ?>#tiedot">Päivä <span class ="glyphicon glyphicon-sort-by-order-alt"></span></th>
                        <th><a href="hallinnointi_henkilon_tiedot.php?id=<?php echo $data->henkilo->getHenkilo_id() ?>&sort=kesto&filter=<?php echo $data->filtteriProjekti; ?>#tiedot">Tunnit <span class ="glyphicon glyphicon-sort-by-order-alt"></span></th>
                        <th><a href="hallinnointi_henkilon_tiedot.php?id=<?php echo $data->henkilo->getHenkilo_id() ?>&sort=lisatiedot&filter=<?php echo $data->filtteriProjekti; ?>#tiedot">Lisätietoja <span class ="glyphicon glyphicon-sort-by-alphabet"></span></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data->henkilonTyosyotteet as $hlo_syote): ?>
                        <tr>
                            <td><?php echo $hlo_syote->getProjekti_nimi(); ?></td>
                            <td><?php echo $hlo_syote->getKuvaus(); ?></td>
                            <td><?php echo $hlo_syote->getPaiva(); ?></td>
                            <td><?php echo $hlo_syote->getKesto(); ?></td>
                            <td><?php echo $hlo_syote->getLisatiedot(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    Ei merkintöjä
                </tbody>
            <?php endif; ?>
        </table>
    </div>  
</div>