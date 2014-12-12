
<!--Henkilön projektin työsyötteet-->
<div class="panel panel-default">
    <div class="panel-heading"><h4 class="panel-title">Projektin tiedot: <?php echo $data->projektinNimi; ?></h4></div>
    <div class="panel-body">
        <table class="table table-striped">                       
            <thead>                          
                <tr>                               
                    <th>työtehtävä</th>
                    <th>päivä</th>
                    <th>Tunnit</th>
                    <th>lisätietoja</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!--Työselitteet tietokannasta-->
                <?php foreach ($data->henkilonSyote as $syote): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($syote->getKuvaus()); ?></td>
                        <td><?php echo $syote->getPaiva(); ?></td>
                        <td><?php echo $syote->getKesto(); ?></td>
                        <td><?php echo htmlspecialchars($syote->getLisatiedot()); ?></td>
                        <td><div class="btn-group" role="group">
                                <form action="projektinSyoteMuokkausJaPoisto.php" method="POST">
                                    <input type="hidden" name="projektiId" value="<?php echo $data->projektiId; ?>">
                                    <button type="submit" name="muokkaa" class="btn btn-default btn-sm" value="<?php echo $syote->getSyote_id(); ?>">Muokkaa</button>
                                    <button type="submit" name="poista" class="btn btn-default btn-sm" value="<?php echo $syote->getSyote_id(); ?>">Poista</button>
                                </form>
                            </div></td> 
                    </tr>
                <?php endforeach; ?>
                <!--Työselitteet tietokannasta-->

            </tbody>
        </table>
    </div>  
</div>
<!--Henkilön projektin työsyötteet, loppu-->

