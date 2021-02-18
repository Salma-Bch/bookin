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
                <h2>Création de votre compte administrateur Book'In</h2>
                <p>Remplissez tout les champs.</p>
                <form id ="infosCompte" class="form-group" method="post" onsubmit="return false">
                    <div class="form-group" id="nom">
                        <input type='text' name="nom" class='form-control form-control-danger' id="inputNom" placeholder='Nom' required=""/>
                    </div>
                    <div class="form-group" id="prenom">
                        <input type='text' name="prenom" class='form-control' id="inputPrenom" placeholder='Prénom' required=""/>
                    </div>
                    <div class="form-group" id="adresse">
                        <input type='text' name="adresse" class='form-control' placeholder='Adresse' required=""/>
                    </div>
                    <div class="form-group" id="codePostale">
                        <input type='text' name="cdp" id="cdp" class='form-control' onkeypress="return onlyNumberKey(event)" placeholder='Code postale' required=""/>
                    </div>
                    <div class="form-group" id="mail">
                        <input type='text' name="mail" id='inputEmail' class='form-control' placeholder='Adresse mail' required=""/>
                    </div>
                    <div class="form-group" id="password">
                        <input type='password' name="mdp" id="mdp" class='form-control' placeholder='Mot de passe' required=""/>
                    </div>
                    <div class="form-group" id="mdpConf">
                        <input type='password' id="mdpConfirm" class='form-control' placeholder='Confirmation du mot de passe' required=""/>
                    </div>
                    <button class='btn btn-lg btn-danger btn-block btn-signin' name="submit"  onclick="createCompte()">Envoyer</button>
                    <a href='espacePersonnel.php'>Retour</a>
                </form>
            </div>
        </div>

        <?php
            include("ressources/include/footer.php");
        ?>
        <script><!--
            function displayEchecCreat(){
                document.getElementById("infosMaj").textContent = "Votre compte n'a pas pu être crée.";
                document.getElementById("modifFailed").setAttribute("fill", "red");
                document.getElementById("modifChecked").setAttribute("display", "none");
                document.getElementById("modifFailed").setAttribute("display", "inline-block");
                $('#dialogModal').modal({
                    show: 'true'
                });
            }

            function displaySuccessCreat(){
                document.getElementById("infosMaj").textContent = "Votre compte a été créé avec succès.";
                document.getElementById("modifChecked").setAttribute("fill", "green") ;
                document.getElementById("modifFailed").setAttribute("display", "none");
                document.getElementById("modifChecked").setAttribute("display", "inline-block");

                $('#dialogModal').modal({
                    show: 'true'
                });
            }

            function validInput(){
                var noError = true;
                var form = document.getElementById("infosCompte");
                var nom = document.getElementById("inputNom").value;
                var prenom = document.getElementById("inputPrenom").value;
                var email = document.getElementById("inputEmail").value;
                var number =document.getElementById("numeroPermis").value;
                var mdp = document.getElementById("mdp").value;
                var mdpConfirm = document.getElementById("mdpConfirm").value;
                var cdp = document.getElementById("cdp").value;

                if(cdp.length < 5 || cdp.length > 5){
                    document.getElementById("codePostale").setAttribute("class","form-group has-error");
                    noError = false;
                }
                if(number.length < 12 || number.length > 15){
                    document.getElementById("permis").setAttribute("class","form-group has-error");
                    noError = false;
                }
                if (!valide(email)) {
                    document.getElementById("mail").setAttribute("class","form-group has-error");
                    noError = false;
                }

                if(mdp ==""){
                    document.getElementById("mdp").setAttribute("class","form-group has-error");
                    noError = false;
                }
                if(mdpConfirm ==""){
                    document.getElementById("mdpConf").setAttribute("class","form-group has-error");
                    noError = false;
                }
                if(mdp != mdpConfirm){
                    document.getElementById("password").setAttribute("class","form-group has-error");
                    document.getElementById("mdpConf").setAttribute("class","form-group has-error");
                    noError = false;
                }
                return noError;
            }

            function valide(email) {
                const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            }
            function onlyNumberKey(evt) {
                var ASCIICode = (evt.which) ? evt.which : evt.keyCode
                if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                    return false;
                return true;
            }

            function createCompte() {
                if (validInput()) {
                    var formCompte = $("#infosCompte").serialize();
                    $.ajax({
                        type: 'post',
                        url: 'checkCreation.php',
                        data: formCompte,
                        success: function (response) {
                            if (response.includes("creation:no")) {
                                displayEchecCreat();
                            } else {
                                displaySuccessCreat();
                            }
                        },
                        error: function () {
                            displayEchecCreat();
                        }
                    });

                }
                else
                    return false;
            }
            //--></script>
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