<?php
    session_start();
    $_SESSION['bookinClient'] = null;
    session_destroy();
    header('Location: ../clientLoginSpace.php');
