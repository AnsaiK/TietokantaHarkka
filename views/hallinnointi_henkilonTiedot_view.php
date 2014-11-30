
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title"><?php echo $data->henkilo->getNimi(); ?></h4></div>
    <div class="panel-body">
        <table class="table table-striped"> 
            <thead>                          
                <tr>                               
                    <th>--</th>
                    <th>--</th>
                    <th>--</th>
                    <th>--</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>tietoja</td>
                    <td>tietoja</td>
                    <td>tietoja</td>
                    <td>tietoja</td> 
                </tr>
            </tbody>
        </table>
    </div>  
</div>


<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">Kaikkien projektien tiedot</h4></div>
    <div class="panel-body">
        <table class="table table-striped">                       
            <thead>                          
                <tr>   
                    <th>projekti</th>
                    <th>työtehtävä</th>
                    <th>päivä</th>
                    <th>Tunnit</th>
                    <th>lisätietoja</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data->henkilonTyosyotteet as $hlo_syote): ?>
                    <tr>
                        <td><?php echo $hlo_syote->getProjekti_nimi();?></td>
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


