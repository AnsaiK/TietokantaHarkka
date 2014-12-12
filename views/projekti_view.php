<!--muokkaus- tai lisäysnäkymän näyttö--> 
<?php require $data->muokkausTaiLisays;?>

<!--php:llä projektin tietojen haku-->
<?php require 'projekti_syotteet_view.php';?>

<ol class="breadcrumb">
    <li><a href="etusivu.php">Home: <?php echo htmlspecialchars($_SESSION['nimi']) ?></a></li>
        <li class="active">Projekti: <?php echo $data->projektinNimi;?></li>
</ol>

