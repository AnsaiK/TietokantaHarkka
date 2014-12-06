<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">Henkilöt</h4>
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Henkilö</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data->henkilo as $henkiloNyt): ?>
                    <tr>               
                        <td><a href="hallinnointi_henkilon_tiedot.php?id=<?php echo $henkiloNyt->getHenkilo_id(); ?>"><?php echo htmlspecialchars($henkiloNyt->getNimi()); ?></a></td>
                        <?php if (isset($_SESSION['admin'])): ?>   
                        <td>onko admin</td>
                            <td><button type = "button" name="admin" class="btn btn-xs btn-default" value="">Tee Adminiksi</button></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>  
</div>

