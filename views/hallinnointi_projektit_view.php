<?php
if (!isset($_SESSION['vastuuhenkilo'])) {
    header('Location: etusivu.php');
    exit();
}
?>

<!--projektin lisäys-->
<?php require $data->listausTaiMuokkaus;?>

<!--projektien listaus-->
<?php require 'hallinnointi_projektit_listaus_view.php'; ?>

<!--valitun projektin tietojen listaus-->
<?php if (!empty($data->projektinNimi)): ?>
    <?php require 'hallinnointi_projektit_valitun_projektin_tiedot_view.php'; ?>
<?php endif; ?>
<!--valitun projektin tietojen listaus-->


<ol class="breadcrumb" >
    <li><a href="etusivu.php">Home: <?php echo htmlspecialchars($_SESSION['nimi']) ?></a></li>
    <li class="active">Hallinnointi: Projektit</li>
</ol>
