<?php
require_once 'libs/common.php';

unset($_SESSION['henkilo']);
unset($_SESSION['nimi']);
unset($_SESSION['henkilo_id']);
unset($_SESSION['vastuuhenkilo']);
unset($_SESSION['admin']);
    
naytaKirjautumisPohja("login_view.php");


