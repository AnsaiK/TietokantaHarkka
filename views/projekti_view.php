<div class="panel panel-default">
    <div class="panel-heading"><h4 class="panel-title">Lisää tapahtuma</h4></div>
    <div class="panel-body">
        <form role="form">
            <div class="row">
                <label class="col-xs-4" for="Tehtävä">Työtehtävä</label>
                <label class="col-xs-2" for="Päivä">Päivä</label>
                <label class="col-xs-2" for="Kesto">Kesto</label>
                <label class="col-xs-4" for="Lisätiedot">Lisätietoja</label>                    
            </div>
            <div class="row">
                <div class="col-xs-4"><input class="form-control" type="text" id ="Tehtävä" placeholder="Työtehtävä"></div>
                <div class="col-xs-2"><input class="form-control" type="date" id ="Päivä" placeholder="14.10.2014"></div>
                <div class="col-xs-2"><input class="form-control" type="time" id ="Kesto" placeholder="2:00"></div>
                <div class="col-xs-4"><input class="form-control" type="text" id ="Lisätiedot" placeholder="Lisätietoja"></div>

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
                    <th><data</th>
                </tr>
            </thead>
            <tbody>
                <!--Työselitteet tietokannasta-->
                <?php foreach ($data->henkilonSyote as $syote): ?>
                    <tr>
                        <td><?php echo $syote->getKuvaus(); ?></td>
                        <td>ei implementoitu vielä</td>
                        <td><?php echo $syote->getKesto(); ?></td>
                        <td></td> 
                        <td><button type="button" class="btn btn-xs btn-default">
                                <span></span>
                                Muokkaa tietoja</button></td>
                    </tr>
                <?php endforeach; ?>
                <!--Työselitteet tietokannasta-->

            </tbody>
        </table>
    </div>  
</div>
<!--Henkilön projektin työsyötteet, loppu-->

</div>