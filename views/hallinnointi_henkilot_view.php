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
                    <th>Status</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($data->listaus as $hlo): ?>
                    <tr>               
                        <td><a href="hallinnointi_henkilon_tiedot.php?id=<?php echo $hlo[0]; ?>"><?php echo $hlo[1]; ?></a></td>
                        <?php if (isset($_SESSION['admin'])) : ?>
                            <?php if (empty($hlo[2])): ?> 
                                <td>käyttäjä</td>
                                <td class ="btn-group" role="group">
                                    <button type="submit" class="btn btn-success btn-sm" name="muokkaa" value="">Lisää <span class="glyphicon glyphicon-ok"></span></button>
                                    <button type="button" class="btn disabled btn-sm" name="muokkaa" value="">Poista <span class="glyphicon glyphicon-remove"></span></button>
                                </td>
                            <?php else: ?>
                                <td>vastuuhenkilo</td>
                                <td class ="btn-group" role="group">
                                    <button type="button" class="btn disabled btn-sm" name="muokkaa" value="">Lisää <span class="glyphicon glyphicon-ok"></span></button>
                                    <button type="submit" class="btn btn-danger btn-sm" name="muokkaa" value="">Poista <span class="glyphicon glyphicon-remove"></span></button>
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