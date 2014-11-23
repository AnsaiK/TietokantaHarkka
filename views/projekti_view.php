<!--Lomake merkintojen lähettämiseen-->

<div class="panel panel-default">
    <div class="panel-heading"><h4 class="panel-title">Lisää tapahtuma</h4></div>
    <div class="panel-body">
        <form role="form" action="projekti.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $data->uusiSyote->getProjekti_id(); ?>">

            <div class="row">
                <label class="col-xs-4" for="Tehtävä">Työtehtävä</label>
                <label class="col-xs-2" for="Päivä">Päivä</label>
                <label class="col-xs-2" for="Kesto">Kesto</label>
                <label class="col-xs-4" for="Lisätiedot">Lisätietoja</label>                    
            </div>
            <div class="row">
                <div class="col-xs-4"><input class="form-control" type="text" name ="tehtava" placeholder="Työtehtävä" value="<?php echo htmlspecialchars($data->uusiSyote->getKuvaus()); ?>"></div>
                <div class="col-xs-2"><input class="form-control" type="text" name ="paiva" placeholder="21-12-2014" value="<?php echo $data->uusiSyote->getPaiva(); ?>"></div>
                <div class="col-xs-2"><input class="form-control" type="text" name ="kesto" placeholder="2" value="<?php echo $data->uusiSyote->getKesto(); ?>"></div>
                <div class="col-xs-4"><input class="form-control" type="text" name ="lisatiedot" placeholder="Lisätietoja" value="<?php echo htmlspecialchars($data->uusiSyote->getLisatiedot()); ?>"></div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <br>
                    <button type="submit" class="btn btn-default">Lisää tiedot</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--Lomake merkintojen lähettämiseen, loppu-->


<!--Henkilön projektin työsyötteet-->
<div class="panel panel-default">
    <div class="panel-heading"><h4 class="panel-title">Projektin tiedot</h4></div>
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
                                <button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil"></span> Muokkaa</button>
                                <button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove"></span> Poista</button>
                            </div></td> 
                    </tr>
                <?php endforeach; ?>
                <!--Työselitteet tietokannasta-->

            </tbody>
        </table>
    </div>  
</div>
<!--Henkilön projektin työsyötteet, loppu-->
