<?php
if (!isset($_SESSION['vastuuhenkilo'])) {
    header('Location: etusivu.php');
    exit();
}
?>

<!--projektitietojen yhteenveto-->
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title"><?php echo $data->henkilo->getNimi(); ?></h4></div>
    <div class="panel-body">
        <table class="table"> 
            <thead>                          
                <tr>                               
                    <th>Projektien määrä</th>
                    <th>Viimeinen merkintä</th>
                    <th>Tunteja yht.</th>
                    <th>Merkintöjä</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="col-xs-3"><?php echo $data->projektiLkm; ?></td>
                    <td class="col-xs-5"><?php echo $data->vikaMerkinta[0]; ?> - <?php echo $data->vikaMerkinta[1]; ?></td>
                    <td class="col-xs-2"><?php echo $data->tunnitJaMerkinnat[0]; ?></td>
                    <td class="col-xs-3"><?php echo $data->tunnitJaMerkinnat[1]; ?></td> 
                </tr>
            </tbody>
        </table>
    </div>  
</div>


<div class="panel panel-default">
    <div class="panel-heading" id="projektit">
        <h4 class="panel-title">Projektit</h4></div>
    <div class="panel-body">
        <table class="table">                       
            <thead>                          
                <tr>   
                    <th>Projekti</th>
                    <th>Projektin kuvaus</th>
                    <th>Tunnit yhteensä</th>
                    <th>Merkintöjä</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data->projektienYhteenveto as $projekti): ?>
                    <tr>               
                        <td class="col-xs-3"><?php echo $projekti[0]; ?></td>
                        <td class="col-xs-5"><?php echo $projekti[1]; ?></td>
                        <td class="col-xs-2"><?php echo $projekti[2]; ?></td>
                        <td class="col-xs-3"><?php echo $projekti[3]; ?></td> 
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>  
</div>


<!--Kaikkien projektien tiedot-->
<div class="panel panel-default">
    <div class="panel-heading" id="tiedot">
        <h4 class="panel-title">Kaikkien projektien merkinnät</h4></div>
    <div class="panel-body">
        <table class="table">                       
            <thead>                          
                <tr>   
                    <th><a href="hallinnointi_henkilon_tiedot.php?id=<?php echo $data->henkilo->getHenkilo_id() ?>&sort=nimi#tiedot">Projekti <span class ="glyphicon glyphicon-sort-by-alphabet"></span></a></th>
                    <th><a href="hallinnointi_henkilon_tiedot.php?id=<?php echo $data->henkilo->getHenkilo_id() ?>&sort=kuvaus#tiedot">Työtehtävä <span class ="glyphicon glyphicon-sort-by-alphabet"></span></th>
                    <th><a href="hallinnointi_henkilon_tiedot.php?id=<?php echo $data->henkilo->getHenkilo_id() ?>&sort=paiva#tiedot">Päivä <span class ="glyphicon glyphicon-sort-by-order-alt"></span></th>
                    <th><a href="hallinnointi_henkilon_tiedot.php?id=<?php echo $data->henkilo->getHenkilo_id() ?>&sort=kesto#tiedot">Tunnit <span class ="glyphicon glyphicon-sort-by-order-alt"></span></th>
                    <th><a href="hallinnointi_henkilon_tiedot.php?id=<?php echo $data->henkilo->getHenkilo_id() ?>&sort=lisatiedot#tiedot">Lisätietoja <span class ="glyphicon glyphicon-sort-by-alphabet"></span></th>
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

            </tbody>
        </table>
    </div>  
</div>

<ol class="breadcrumb">
    <li><a href="etusivu.php">Home: <?php echo htmlspecialchars($_SESSION['nimi']) ?></a></li>
    <li><a href="hallinnointi_henkilot.php">Hallinnointi: henkilöt</a></li>
            <li class="active"><?php echo $data->henkilo->getNimi(); ?></li>

</ol>

