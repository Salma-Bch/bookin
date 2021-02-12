<!DOCTYPE html>
<html lang="fr">
    <?php
        /**
         * \file      creationCompte.php
         * \author    Salma BENCHELKHA - Mouncif LEKMITI - Enzo CERINI
         * \version   1.0
         * \date      8 janvier 2020
         * \brief     Affiche la page de création de compte.
         * \details   Formulaire à remplir par l'utilisateur afin d'obtenir un espace personnel.
         */
    ?>
    <head>
        <?php
            include_once("ressources/include/head.php");
        ?>
        <title>Création de compte</title>
    </head>

    <body>
        <?php
            include("ressources/include/header.php");
        ?>
        <div class ='container-connexion'>
            <div class='card card-container-mdp'>
                <h2 class="mb-5 mt-5" style="margin-left: 0;">Création de votre compte Book'In</h2>
                <form id ="compteInfo" class="form-group" method="post" onsubmit="return false">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type='text' name="lastName" class='form-control form-control-danger' placeholder='Nom' required=""/>
                        </div>
                        <div class="form-group col-md-6">
                            <input type='text' name="firstName" class='form-control' placeholder='Prénom' required=""/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <input type='text' name="mail" class='form-control' placeholder='Adresse mail' required=""/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type='password' name="psd" class='form-control' placeholder='Mot de passe' required=""/>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="psdShow">
                                <label class="form-check-label" for="psdShow">Afficher le mot de passe</label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <input type='password' name="psdConfirmation" class='form-control' placeholder='Confirmer' required=""/>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <button class='btn btn-lg btn-danger btn-block btn-signin' name="submit"  onclick="createCompte()">Envoyer</button>
                    </div>
                    <div class="form-group col-md-12">
                        <p>Vous possédez déjà un compte ? <a href='clientLoginSpace.php'>Identifiez-vous</a></p>
                    </div>
                </form>
            </div>
        </div>

        <?php
            include("ressources/include/footer.php");
        ?>

        <script type="text/javascript" src="./js/script.js"></script>


        <div class="modal fade" id="dialogModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&#xd7;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Création de compte</h4>
                    </div>
                    <div class="modal-body">
                        <svg style="vertical-align: middle; margin-right: 10px" id="modifChecked" width="30" height="30" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                        <svg style="vertical-align: middle; margin-right: 10px" id="modifFailed" width="30" height="30" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                        </svg>
                        <p id="infosMaj" style="display: inline-block;">Votre compte a été créé avec succés.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>