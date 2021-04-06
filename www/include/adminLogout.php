<?php
    session_start();
    $_SESSION['bookinAdministrator'] = null;
    session_destroy();
    header('Location: ../administratorLoginSpace.php');
