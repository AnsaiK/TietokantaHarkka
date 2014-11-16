<?php if (!isset($_SESSION['henkilo'])) {
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
                
        <ol class="breadcrumb">
            <li><a href="#" class="active">Home</a></li>
        </ol>

        <div class="container">

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation"  ><a href="#">Home</a></li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Hallinnointi <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"><a href="henkilot.html">Henkilöt</a></li>
                        <li role="presentation"><a href="projektit.html">Projektit</a></li>
                    </ul>
                </li>
                <li role="presentation"><a href="logout.php">Kirjaudu ulos</a></li>
            </ul>

            <h1></h1>

            <?php require $sivu; ?>

        </div>


        <!-- Bootstrap core JavaScript
================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="../js/bootstrap.js"></script>
    </body>
</html>