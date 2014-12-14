<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">Projektit: <?php echo $data->projektiLkm; ?> kpl</h4>
    </div>
    <div class="panel-body">
        <!-- Table -->
        <table class="table">
            <thead>
                <tr>    
                    <th>Projekti</th>
                    <th>Kuvaus</th>
                    <th>Henkilöitä</th>                 
                    <th>Merkintöjä</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($data->projektitJaLkm as $projektit): ?>
                    <tr>
                        <td><a href="hallinnointi_projektit.php?id=<?php echo $projektit->getProjekti_id(); ?>#headingTiedot"><?php echo htmlspecialchars($projektit->getNimi()); ?></a></td>
                        <td><?php echo htmlspecialchars($projektit->getKuvaus()); ?></td>
                        <td><?php echo $projektit->getHlomaara(); ?></td>
                        <td><?php echo $projektit->getSyotteidenMaara(); ?></td>

                        <td><div class="btn-group" role="group">
                                <form action="hallinnointi_projektinMuokkausjaPoisto.php" method="POST">
                                    <button type="submit" class="btn btn-default btn-sm" name="muokkaa" value="<?php echo $projektit->getProjekti_id(); ?>">Muokkaa</button>
                                    <?php if (isset($_SESSION['admin'])) : ?>
                                        <button type="submit" class="btn btn-default btn-sm" name="poista" value="<?php echo $projektit->getProjekti_id(); ?>">Poista</button>
                                    <?php endif; ?>
                                </form>
                            </div></td>     
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>