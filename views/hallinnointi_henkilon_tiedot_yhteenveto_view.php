<div class="panel panel-default">
    <div class="panel-heading" id="yhteenveto">
        <h4 class="panel-title">Projektit: <?php echo htmlspecialchars($data->henkilo->getNimi()); ?></h4></div>
    <div class="panel-body">
        <table class="table">                       
            <thead>                          
                <tr>   
                    <th>Projekti</th>
                    <th>Projektin kuvaus</th>
                    <th>Tunnit yht.</th>
                    <th>Merkintöjä</th>
                    <th>Suodata projekteittain</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data->projektienYhteenveto as $projekti): ?>
                    <tr>  
                        <!--projektikohtainen yhteenveto ja filtteröinti-checkbox. Array[0] = id, Array[1] = nimi, Array[2] = kuvaus, Array[3] = tunnit yhteensä, Array[4] = merkintöjen lkm-->
                        <td class="col-xs-3"><a href="hallinnointi_projektit.php?id=<?php echo $projekti[0] ?>#headingTiedot"><?php echo htmlspecialchars($projekti[1]); ?></a></td>
                        <td class="col-xs-5"><?php echo htmlspecialchars($projekti[2]); ?></td>
                        <td class="col-xs-1"><?php echo $projekti[3]; ?></td>
                        <td class="col-xs-1"><?php echo $projekti[4]; ?></td> 
                        <td class="col-xs-3"><input type="checkbox" name="redirect" value="hallinnointi_henkilon_tiedot.php?id=<?php echo $data->henkilo->getHenkilo_id(); ?>&filter=<?php echo $projekti[0]; ?>#tiedot" 
                                                    <?php if ($projekti[0] == $data->filtteriProjekti): ?> checked="checked"<?php endif; ?>
                                                    ></td>
                    </tr>
                <?php endforeach; ?>

                <!--kaikkien projektien yhteenveto, Array[0] = tunnit yhteensä, Array[1] = merkintöjen lkm-->
                <tr>
                    <td class="col-xs-3"><strong>Kaikki projektit: <?php echo $data->projektiLkm; ?> kpl</strong></td>
                    <td class="col-xs-5"></td>
                    <td class="col-xs-1"><strong><?php echo $data->tunnitJaMerkinnat[0]; ?></strong></td>
                    <td class="col-xs-1"><strong><?php echo htmlspecialchars($data->tunnitJaMerkinnat[1]); ?></strong></td> 
                    <td class="col-xs-3"><input type="checkbox" name="redirect" value="hallinnointi_henkilon_tiedot.php?id=<?php echo $data->henkilo->getHenkilo_id(); ?>#tiedot"<?php if (empty($data->filtteriProjekti)): ?> checked="checked"<?php endif; ?>></td>

                </tr>

                <!--checkboxin filtteröinnin scripti-->
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
            <script>
                $('input[type="checkbox"]').on('click', function () {
                    window.location = $(this).val();
                });
            </script>
            </tbody>
        </table>
    </div>  
</div>

