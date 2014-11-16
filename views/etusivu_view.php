<?php
require_once 'libs/models/Projekti.php'
?>

<!-- Omat projektit -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">Projektisi: <?php echo $_SESSION['nimi'] ?></li>
        </h4>
    </div>
    <div class="panel-body">

        <table class="table table-striped">
            <thead>
                <!-- Otsikot -->
                <tr>
                    <th>Projekti</th>
                    <th>Kuvaus</th>
                    <th>Tunnit</th>
                    <th>Viimeinen merkintä</th>
                </tr>
                <!-- Otsikot loppu -->
            </thead>
            <tbody>
                <!-- Projektin tiedot tietokannasta -->
                <?php foreach ($data->omatprojektit as $omatprojektitiedot): ?>
                    <tr>
                        <td><a href="projekti.php?id=<?php echo $omatprojektitiedot->getProjekti_id(); ?>"><?php echo $omatprojektitiedot->getNimi(); ?></a></td>
                        <td><?php echo $omatprojektitiedot->getKuvaus(); ?></td>
                        <td>13</td>
                        <td>23.09.2014</td>
                    </tr>
                <?php endforeach; ?>
                <!-- Projektin tiedot tietokannasta, loppu -->
            </tbody>
        </table>
    </div> 
</div>
<!-- Omat projektit loppu-->


<!-- Kaikki projektit, collapsible panel-->        
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Kaikki projektit: <?php echo $data->projektiLkm; ?> kpl</a>
            </h4>
        </div>
        <div id = "collapseOne" class = "panel-collapse collapse in" role = "tabpanel" aria-labelledby = "headingOne">
            <div class = "panel-body">
                <table class = "table table-striped">
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
                        <!-- Kaikkien projektien tiedot tietokannasta -->
                        <?php foreach ($data->kaikkiprojektit as $projektitiedot): ?>
                            <tr>
                                <td><?php echo $projektitiedot->getNimi(); ?></td>
                                <td><?php echo $projektitiedot->getKuvaus(); ?></td>
                                <td><button type = "button" class = "btn btn-xs btn-default">Liity projektiin</button></td>
                            </tr>
                        <?php endforeach; ?>
                        <!-- Kaikkien projektien tiedot tietokannasta, loppu -->

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Kaikki projektit loppu, collapsible panel-->        


