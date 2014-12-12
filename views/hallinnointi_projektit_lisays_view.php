<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="projektin_lisays">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseLisays"
               aria-expanded="true" aria-controls="collapseLisays">Lisää projekti</a>
        </h4>
    </div>
    <div id="collapseLisays" class="panel-collapse collapse-in" role="tabpanel" aria-labelledby="projektin_lisays">
        <div class="panel-body">
            <form role="form" action="hallinnointi_projektinLisays.php" method="POST">
                <div class="row">
                    <label class="col-xs-6" for="Projekti_nimi">Projektin nimi</label>
                    <label class="col-xs-6" for="Kuvaus">Kuvaus</label>                    
                </div>
                <div class="row">
                    <div class="col-xs-6"><input class="form-control" type="text" name ="lisattavanProjektinNimi" placeholder="Projektin nimi" value="<?php echo htmlspecialchars($data->lisattavanProjektinNimi); ?>"></div>
                    <div class="col-xs-6"><input class="form-control" type="text" name ="lisattavanProjektinKuvaus" placeholder="Kuvaus" value="<?php echo htmlspecialchars($data->lisattavanProjektinKuvaus); ?>"></div>

                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <br>
                        <button type="submit" class="btn btn-default">Lisää projekti</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
