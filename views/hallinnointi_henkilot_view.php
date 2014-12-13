<?php
if (!isset($_SESSION['vastuuhenkilo'])) {
    header('Location: etusivu.php');
    exit();
}
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">Henkilöt</h4>
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Henkilö</th>
                    <th>Tunteja</th>
                    <th>Merkintöjä</th>

                    <?php if (isset($_SESSION['admin'])) : ?>
                        <th>Käyttöoikeudet</th>
                        <th>Vastuuhenkilön oikeudet</th>
                    <?php endif; ?>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($data->henkilo as $hlo): ?>
                    <tr>               
                        <td><a href="hallinnointi_henkilon_tiedot.php?id=<?php echo $hlo->getHenkilo_id(); ?>"><?php echo $hlo->getNimi(); ?></a></td>
                        <td class ="col-xs-2"><?php echo $hlo->getTunnit(); ?></td>
                        <td class ="col-xs-2"><?php echo $hlo->getMerkinnat();?></td>
                        
                        <?php if (isset($_SESSION['admin'])) : ?>
                            <?php if ($hlo->getAdmin()): ?> 
                                <td>Admin</td>
                                <td class ="col-xs-2 btn-group" role="group">
                                    <button type="button" class="btn disabled btn-sm" name="lisaa" value="">Lisää <span class="glyphicon glyphicon-ok"></span></button>
                                    <button type="button" class="btn disabled btn-sm" name="poista" value="">Poista <span class="glyphicon glyphicon-remove"></span></button>
                                </td>
                            <?php elseif ($hlo->getVastuuhenkilo()): ?> 
                                <td>vastuuhenkilo</td>

                                <td class ="col-xs-2 btn-group" role="group">
                                    <form action="hallinnointi_henkilot.php" method="POST">
                                        <button type="submit" class="btn disabled btn-sm" name="lisaa" value="<?php echo $hlo->getHenkilo_id(); ?>">Lisää <span class="glyphicon glyphicon-ok"></span></button>
                                        <button type="submit" class="btn btn-danger btn-sm" name="poista" value="<?php echo $hlo->getHenkilo_id(); ?>">Poista <span class="glyphicon glyphicon-remove"></span></button>
                                    </form>    
                                </td>

                            <?php else: ?>
                                <td>käyttäjä</td>
                                <td class ="col-xs-2 btn-group" role="group">
                                    <form action="hallinnointi_henkilot.php" method="POST">
                                        <button type="submit" class="btn btn-success btn-sm" name="lisaa" value="<?php echo $hlo->getHenkilo_id(); ?>">Lisää <span class="glyphicon glyphicon-ok"></span></button>
                                        <button type="submit" class="btn disabled btn-sm" name="poista" value="<?php echo $hlo->getHenkilo_id(); ?>">Poista <span class="glyphicon glyphicon-remove"></span></button>
                                    </form>    

                                </td>
                            <?php endif; ?>
                        <?php endif; ?>
                    </tr>
                <?php endforeach;
                ?>
            </tbody>
        </table>
    </div>  
</div>

<ol class="breadcrumb">
    <li><a href="etusivu.php">Home: <?php echo htmlspecialchars($_SESSION['nimi']) ?></a></li>
    <li class="active">Hallinnointi: henkilöt</li>

</ol>