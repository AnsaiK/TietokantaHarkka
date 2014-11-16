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
            <h2>Sign in</h2>

            <form role="form" action="login.php" method="POST">
                <div class="row">
                    <div class="col-xs-4"><input class="form-control" type="text" name ="username" value="<?php echo $data->kayttajatunnus; ?>" placeholder="Käyttäjätunnus"/>
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
                        <button type="submit" class="btn btn-default">Sign in</button>
                    </div>
                </div>
                <p></p>
                <!--virheilmoitus-->
                <?php if (!empty($data->virhe)): ?>
                    <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
                <?php endif; ?>
                <!--virheilmoitus, loppu-->
                <div class="row">
                    <div class="col-xs-12">
                        Ei tunnuksia? <a href="logon.html">Kirjaudu tästä.</a>
                    </div>
                </div>
            </form>           
        </div>
    </div>
</div>
</body>
</html>