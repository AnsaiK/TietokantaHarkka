<!--muokkaus- tai lisäysnäkymän näyttö--> 
<?php require_once $data->muokkausTaiLisays;?>

<!--php:llä projektin tietojen haku-->
<?php require_once 'projekti_syotteet_view.php';?>

<ol class="breadcrumb">
    <li><a href="etusivu.php">Home: <?php echo htmlspecialchars($_SESSION['nimi']) ?></a></li>
        <li class="active">Projekti: <?php echo htmlspecialchars($data->projektinNimi);?></li>
</ol>

