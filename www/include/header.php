<?php
/**
 * \file      header.php
 * \author    Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
 * \version   1.0
 * \date      8 janvier 2020
 * \brief     Permet l'affichage du header dee l'application web Book'In.
 * \details   Utilisation dans chaque page du site web.
 */
?>
<header>
    <nav class="navbar navbar-inverse menu">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <a href="index.php"></a><img class = "logo" src="ressources/images/logo_couleur.png" alt="Logo"/></a>
                    </div>
                    <div class="col-md-6">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#NavNav">
                                <span class="icon-bar icon-bar-perso"></span>
                                <span class="icon-bar icon-bar-perso"></span>
                                <span class="icon-bar icon-bar-perso"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="NavNav">
                            <ul class="nav navbar-nav">
                              <li><a href="index.php">ACCUEIL</a></li>
                              <li><a href="searchSpace.php">NOS LIVRES</a></li>
                              <li><a href="clientLoginSpace.php">MON ESPACE</a></li>
                              <li><a href="informationSpace.php">À PROPOS</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
