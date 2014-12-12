<!--projektin muokkaus-->
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default-edit">
        <div class="panel-heading-edit" role="tab" id="projektin_lisays">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseLisays" aria-expanded="true" aria-controls="collapseLisays">
                    Muokkaa projektia
                </a>
            </h4>
        </div>
        <div id="collapseLisays" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="projektin_lisays">
            <div class="panel-body">
                <form role="form" action="hallinnointi_projektinMuokkausjaPoisto.php" method="POST">
                    <div class="row">
                        <label class="col-xs-6" for="Projekti_nimi">Projektin nimi</label>
                        <label class="col-xs-6" for="Kuvaus">Kuvaus</label>                    
                    </div>
                    <div class="row">
                        <div class="col-xs-6"><input class="form-control" type="text" name ="muokattavanProjektinNimi" placeholder="Projektin nimi" value="<?php echo htmlspecialchars($data->muokattavanProjektinNimi);?>"></div>
                        <div class="col-xs-6"><input class="form-control" type="text" name ="muokattavanProjektinKuvaus" placeholder="Kuvaus" value="<?php echo htmlspecialchars($data->muokattavanProjektinKuvaus); ?>"></div>

                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <br>
                            <button type="submit" class="btn btn-default" name="vahvista" value="<?php echo $data->muokattavaProjektiId;?>">Vahvista muokkaukset</button>
                            <a href="hallinnointi_projektit.php" button type="submit" class="btn btn-default" name="peruuta">Peruuta</a>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--projektin muokkaus, loppu-->
