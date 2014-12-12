<?php
if (!isset($_SESSION['henkilo'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Projektin ajanhallintajärjestelmä</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-theme.css" rel="stylesheet">
        <link href="../css/main.css" rel="stylesheet">
    </head>
    <body>

        <div class="container">

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation"  ><a href="etusivu.php">Home</a></li>
                <?php if (isset($_SESSION['vastuuhenkilo'])): ?>    
                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Hallinnointi <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a href="hallinnointi_henkilot.php">Henkilöt</a></li>
                            <li role="presentation"><a href="hallinnointi_projektit.php">Projektit</a></li>
                        </ul>
                    </li>
                    <?php
                endif;
                ?>
                <li role="presentation"><a href="logout.php">Kirjaudu ulos</a></li>
            </ul>

            <h1></h1>

            <?php if (!empty($_SESSION['huomautus'])): ?>
                <div class="alert alert-danger">
                    <?php if (is_array($_SESSION['huomautus'])): ?>
                        <ul>
                            <?php foreach ($_SESSION['huomautus'] as $ilmoitus): ?>
                                <li><?php echo $ilmoitus ?></li>
                            <?php endforeach; ?>
                        </ul>

                    <?php else: ?>
                        <p><?php echo $_SESSION['huomautus'] ?></p>
                    <?php endif; ?>
                </div>
                <?php
                unset($_SESSION['huomautus']);
            endif;
            ?>



            <?php if (!empty($_SESSION['kuittaus'])): ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['kuittaus']; ?>
                </div>
                <?php
                // Samalla kun viesti näytetään, se poistetaan istunnosta,
                // ettei se näkyisi myöhemmin jollain toisella sivulla uudestaan.
                unset($_SESSION['kuittaus']);
            endif;
            ?>

            <?php require $sivu; ?>

        </div>


        <!-- Bootstrap core JavaScript
================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="../js/bootstrap.js"></script>
    </body>
</html>
