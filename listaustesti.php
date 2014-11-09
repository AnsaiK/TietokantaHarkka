<?php
  //require_once sisällyttää annetun tiedoston vain kerran
  require_once "libs/tietokantayhteys.php"; 
  
  $sql = "SELECT nimi, kayttajatunnus FROM Henkilo";
  $kysely = getTietokantayhteys()->prepare($sql);
  $kysely->execute(); 
?><!DOCTYPE HTML>
<html>
  <head><title>Otsikko</title></head>
  <body>
    <h1>Listaelementtitesti, käyttäjien nimet ja käyttajätunnus listana</h1>
    <ul>
    <?php foreach($kysely->fetchAll()as $asia) { ?>
      <li><?php echo $asia[0].'  - käyttäjätunnus: '.$asia[1]; ?></li>
    <?php } ?>
    </ul>
  </body>
</html>