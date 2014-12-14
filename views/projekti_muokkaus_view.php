<!--Lomake merkintojen lähettämiseen-->

<div class="panel panel-default-edit">
    <div class="panel-heading-edit"><h4 class="panel-title">Muokkaa tietoja</h4></div>
    <div class="panel-body">
        <form role="form" action="projektinSyoteMuokkausJaPoisto.php" method="POST">
            <input type="hidden" name="projektiId" value="<?php echo $data->projektiId; ?>">

            <div class="row">
                <label class="col-xs-4" for="Tehtävä">Työtehtävä</label>
                <label class="col-xs-2" for="Päivä">Päivä</label>
                <label class="col-xs-2" for="Kesto">Kesto</label>
                <label class="col-xs-4" for="Lisätiedot">Lisätietoja</label>                    
            </div>
            <!--rivit tietokannasta-->
            <div class="row">
                <div class="col-xs-4"><input class="form-control" type="text" name ="tehtava" placeholder="Työtehtävä" value="<?php echo htmlspecialchars($data->uusiSyote->getKuvaus()); ?>"></div>
                <div class="col-xs-2"><input class="form-control" type="text" name ="paiva" placeholder="21-12-2014" value="<?php echo $data->uusiSyote->getPaiva(); ?>"></div>
                <div class="col-xs-2"><input class="form-control" type="text" name ="kesto" placeholder="2" value="<?php echo $data->uusiSyote->getKesto(); ?>"></div>
                <div class="col-xs-4"><input class="form-control" type="text" name ="lisatiedot" placeholder="Lisätietoja" value="<?php echo htmlspecialchars($data->uusiSyote->getLisatiedot()); ?>"></div>
            </div>
            <!--rivit tietokannasta-->
            <div class="row">
                <div class="col-xs-12">
                    <br>
                    <button type="submit" class="btn btn-default" name="vahvista" value="<?php echo $data->uusiSyote->getSyote_id(); ?>">Vahvista muokkaukset</button>
                    <a href="projekti.php?id=<?php echo $data->projektiId; ?>" button type="submit" class="btn btn-default" name="peruuta">Peruuta</a>
                </div>
            </div>
        </form>
    </div>
</div>
<!--Lomake merkintojen lähettämiseen, loppu-->

