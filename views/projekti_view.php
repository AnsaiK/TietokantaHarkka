<!--Lomake merkintojen lähettämiseen-->

<div class="panel panel-default">
    <div class="panel-heading"><h4 class="panel-title">Lisää tapahtuma</h4></div>
    <div class="panel-body">
        <form role="form" action="projektinSyoteLisays.php" method="POST">
            <input type="hidden" name="projektiId" value="<?php echo $data->projektiId; ?>">
            <div class="row">
                <label class="col-xs-4" for="Tehtävä">Työtehtävä</label>
                <label class="col-xs-2" for="Päivä">Päivä</label>
                <label class="col-xs-2" for="Kesto">Kesto</label>
                <label class="col-xs-4" for="Lisätiedot">Lisätietoja</label>                    
            </div>
            <div class="row">
                <div class="col-xs-4"><input class="form-control" type="text" name ="tehtava" placeholder="Työtehtävä" value="<?php echo htmlspecialchars($data->uusiSyote->getKuvaus()); ?>"></div>
                <div class="col-xs-2"><input class="form-control" type="text" name ="paiva" placeholder="<?php echo date('d-m-Y')?>" value="<?php echo $data->uusiSyote->getPaiva(); ?>"></div>
                <div class="col-xs-2"><input class="form-control" type="text" name ="kesto" placeholder="2" value="<?php echo $data->uusiSyote->getKesto(); ?>"></div>
                <div class="col-xs-4"><input class="form-control" type="text" name ="lisatiedot" placeholder="Lisätietoja" value="<?php echo htmlspecialchars($data->uusiSyote->getLisatiedot()); ?>"></div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <br>
                    <button type="submit" class="btn btn-default" name="lisaa" value="<?php echo '2' ?>">Lisää tiedot</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--Lomake merkintojen lähettämiseen, loppu-->


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
