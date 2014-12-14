<?php
if (!isset($_SESSION['vastuuhenkilo'])) {
    header('Location: etusivu.php');
    exit();
}
?>

<!--projektien listaus ja yhteenvetotiedot-->
<?php require_once 'hallinnointi_henkilon_tiedot_yhteenveto_view.php'?>


<!-- projektien tai suodatetun projektin merkinnät-->
<?php require_once 'hallinnointi_henkilon_tiedot_merkinnat_view.php'?>


<ol class="breadcrumb">
    <li><a href="etusivu.php">Home: <?php echo htmlspecialchars($_SESSION['nimi']) ?></a></li>
    <li><a href="hallinnointi_henkilot.php">Hallinnointi: henkilöt</a></li>
    <li class="active"><?php echo htmlspecialchars($data->henkilo->getNimi()); ?></li>

</ol>

