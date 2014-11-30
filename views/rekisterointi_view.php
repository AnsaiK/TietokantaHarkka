<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link href="../css/bootstrap.css"  rel="stylesheet"/>
        <link href="../css/bootstrap-theme.css" rel="stylesheet"/>
        <link href="../css.main.css" rel = "stylesheet"/>     
    </head>
    <body>
        <div class="container">
            <h2>Rekisteröidy käyttäjäksi</h2>

            <form role="form" action="rekisterointi.php" method="POST">
                <div class="row">
                    <div class="col-xs-4">
                        <input class="form-control" type="text" name ="name" value="<?php echo htmlspecialchars($data->nimi); ?>" placeholder="Koko nimi">
                    </div>
                </div>
                <div class="row">
                    <p></p>
                    <div class="col-xs-4">
                        <input class="form-control" type="text" name ="username" value="<?php echo htmlspecialchars($data->kayttajatunnus); ?>" placeholder="Käyttäjätunnus">
                    </div>
                </div>
                <div class="row">
                    <p></p>
                    <div class="col-xs-4"><input class="form-control" type="password" name ="password" placeholder="Salasana">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <p></p>
                        <button type="submit" class="btn btn-default">Rekisteröidy</button>
                    </div>
                </div>
                <p></p>
                <!--virheilmoitus-->
                <?php if (!empty($data->virhe)): ?>
                    <div class="alert alert-danger">
                        <?php if (isset($data->virhe)): ?>
                            <?php if (is_array($data->virhe)): ?>
                                <ul>
                                    <?php foreach ($data->virhe as $ilmoitus): ?>
                                        <li><?php echo $ilmoitus ?></li>
                                    <?php endforeach; ?>
                                </ul>

                            <?php else: ?>
                                <p><?php echo $data->virhe ?></p>
                            <?php endif; ?>
                        <?php endif; ?>                            
                    </div>
                <?php endif; ?>
                <!--virheilmoitus, loppu-->               
            </form>           
        </div>
    </body>
</html>