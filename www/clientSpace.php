<?php
    /**
     * \file      espacePersonnel.php
     * \author    Salma BENCHELKHA - Mouncif LEKMITI - Enzo CERINI
     * \version   1.0
     * \date      8 janvier 2020
     * \brief     Affiche l'espace personnel de l'utilisateur.
     * \details   Onglet "Mes informations personnelles" + Onglet "Mes réservations"
     */

    include_once('ressources/class/DAOFactory.php');
    include_once('ressources/class/Connection.php');
    include_once('ressources/class/ClientDao.php');
    include_once('ressources/class/Client.php');
    session_start();

    if(!isset($_SESSION['client'])){
        header('Location: espaceConnexion.php');
        exit(0);
    }
    $client = $_SESSION['client'];
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php
            include_once("ressources/include/head.php");
        ?>
        <title>Espace personnel</title>
    </head>
    <body>
        <?php
            include_once("ressources/include/header.php");
        ?>
        <script>
            var client = <?php echo json_encode($client->toAssocArray(),JSON_INVALID_UTF8_SUBSTITUTE); ?>;
            var locations = null;
        </script>
        <div class="container">
            <h2 id="titleName">Bonjour <?php echo $client->getPrenom()." ".$client->getNom() ?></h2>
            <p>Bienvenue dans ton espace personnel. Tu trouvera ici toute les informations te concernant. </p>
        </div>
        <div class="container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#clientInfosDiv">Mes informations personnelles</a></li>
                <li onclick="getReservations();"><a data-toggle="tab" href="#sectionB">Mes reservations</a></li>
            </ul>
            <div class="tab-content ">
                <div class="tab-pane fade in active" id="clientInfosDiv">
                    <table class="table table-dark" id="a">
                        <tbody id='tableauInfo'>
                        <tr>
                            <td id="tabNom"><b>Nom :</b> <?php echo $client->getNom() ?></td>
                            <td id="Tabprenom"><b>Prénom :</b> <?php echo $client->getPrenom() ?></td>
                        </tr>
                        <tr>
                            <td id="tabNumClient"><b>Numéro client :</b> <?php echo $client->getNoClient();?></td>
                            <td id="tabMail"><b>Adresse mail :</b> <?php echo $client->getMail();?></td>
                        </tr>
                        <tr>
                            <td id="tabNumPermis"><b>Numéro de permis :</b> <?php echo $client->getNoPermis();?></td>
                            <td id="tabAdresse"><b>Adresse postale :</b> <?php echo $client->getAdresse();?></td>
                        </tr>
                        </tbody>
                        <tr><td></td><td></td></tr>
                    </table>
                    <div class="col-sm-6 col-xs-12">
                        <input type="submit" class="btn modifEtDeco" id="modifButton" name="submit" value="Modifier mes informations" onclick="showModifInfosForm()" />
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <form action="../../../../../wamp64/www/boooooooook/ressources/include/logout.php" method="POST">
                            <input type="submit" class="btn modifEtDeco" value="Déconnexion" />
                        </form>
                    </div>
                    <div class="container compte" id="infosModifDiv" style="display: none;">
                        <h2>Modifiez vos informations</h2>
                        <div class="form-group">
                            <form id="infosModifForm">
                                <label for="no_client">N° de client : </label>
                                <input type="text" class="form-control" name="no_client" id="no_client" readonly="" value="<?php echo $client->getNoClient();?>" />

                                <label for="nom">Nom : </label>
                                <input type="text" class="form-control" id="nom" name="nom" required="" value="<?php echo $client->getNom();?>" />

                                <label for="prenom">Prénom : </label>
                                <input type="text" class="form-control" id="prenom" required="" name="prenom" value="<?php echo $client->getPrenom();?>" />

                                <label for="no_permis">Numéro de permis :</label>
                                <input type="text" class="form-control" id="no_permis" required="" name="no_permis" value="<?php echo $client->getNoPermis();?>" />

                                <label for="adresse">Adresse postale : </label>
                                <input type="text" class="form-control" id="adresse" required="" name="adresse" value="<?php echo $client->getAdresse();?>" />

                                <label for="mail">Adresse mail :</label>
                                <input type="text" class="form-control" id="mail" required="" name="mail" value="<?php echo $client->getMail();?>" />

                                <label for="mdp">Mot de passe :</label>
                                <input type="password" class="form-control" id="mdp" required="" name="mdp" value="<?php echo $client->getMdp();?>" />

                                <button type="button" class="btn modifEtDeco" id="saveModifications" value="submit" name="submit" onclick="sendData()" data-toggle="modal" data-target="#dialogModal">
                                    Enregistrer les modifications
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="sectionB" class="tab-pane fade">
                    <table class="table table-dark" id="loationsTab">
                        <thead>
                            <tr>
                                <td id="tabNumLoc">Numéro de location</td>
                                <td id="tabDates">Date</td>
                                <td id="tabVehicule">Véhciule</td>
                                <td id="tabPrix">Prix</td>
                                <td id="tabFacture">Facture</td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="dialogModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&#xd7;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modification de vos informations personnelles</h4>
                    </div>

                    <div class="modal-body">
                        <svg style="vertical-align: middle; margin-right: 10px" id="modifChecked" width="30" height="30" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                        <svg style="vertical-align: middle; margin-right: 10px" id="modifFailed" width="30" height="30" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                        </svg>
                        <p id="infosMaj" style="display: inline-block;">Vos informations personnelles ont été mises à jour.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
            include("ressources/include/footer.php");
        ?>
        <script><!--
            function changeInfoClient(id, previousInformation, newInformation){
                var balise = document.getElementById(id);
                balise.textContent = balise.textContent.replace(previousInformation, newInformation);
            }

            function updateInfosClient(oldClient, newClient){
                changeInfoClient("titleName",oldClient["prenom"]+" "+oldClient['nom'],newClient["prenom"]+" "+newClient['nom']);
                changeInfoClient("tabNom",oldClient["nom"],newClient["nom"]);
                changeInfoClient("Tabprenom",oldClient["prenom"],newClient["prenom"]);
                changeInfoClient("tabNumClient",oldClient["noClient"],newClient["noClient"]);
                changeInfoClient("tabMail",oldClient["mail"],newClient["mail"]);
                changeInfoClient("tabNumPermis",oldClient["noPermis"],newClient["noPermis"]);
                changeInfoClient("tabAdresse",oldClient["adresse"],newClient["adresse"]);
                updateInfosClientForm(newClient);
            }

            function updateInfosClientForm(newClient){
                document.getElementById("no_client").value = newClient["noClient"];
                document.getElementById("nom").value = newClient["nom"];
                document.getElementById("prenom").value = newClient["prenom"];
                document.getElementById("no_permis").value = newClient["noPermis"];
                document.getElementById("adresse").value = newClient["adresse"];
                document.getElementById("mail").value = newClient["mail"];
                document.getElementById("mdp").value = newClient["mdp"];
            }

            function showModifInfosForm() {
                document.getElementById("infosModifDiv").style.display = "block";
                document.getElementById("modifButton").onclick =hideModifInfosForm;
                infoDesabled();
            }

            function hideModifInfosForm(){
                document.getElementById("infosModifDiv").style.display = "none";
                document.getElementById("modifButton").onclick =showModifInfosForm;
                infoEnabled();
            }
            function infoEnabled(){
                var element = document.getElementById('tableauInfo') ;
                element.style.background ='white';
                element.style.opacity='1';
                // document.getElementById("a").style.display = "block";
            }
            function infoDesabled() {
                var element = document.getElementById('tableauInfo') ;
                element.style.background ='silver';
                element.style.opacity='0.7';
            }

            function displaySuccessMdif(){
                document.getElementById("infosMaj").textContent = "Vos informations personnelles ont été mises à jour.";
                document.getElementById("modifChecked").setAttribute("fill", "green") ;
                document.getElementById("modifFailed").setAttribute("display", "none");
                document.getElementById("modifChecked").setAttribute("display", "inline-block");
            }

            function displayEchecModif(){
                document.getElementById("infosMaj").textContent = "Vos informations personnelles n'ont pas été mises à jour.";
                document.getElementById("modifFailed").setAttribute("fill", "red");
                document.getElementById("modifChecked").setAttribute("display", "none");
                document.getElementById("modifFailed").setAttribute("display", "inline-block");
            }

            function sendData() {
                if (validInput()) {
                    var formData = $("#infosModifForm").serialize();
                    $.ajax({
                        type: 'post',
                        url: 'updateClientData.php',
                        data: formData,
                        success: function (response) {
                            if (response.includes("maj:no")) {
                                displayEchecModif();
                                updateInfosClientForm(client);
                            } else {
                                displaySuccessMdif();
                                var oldClient = client;
                                var newClient = JSON.parse(response);
                                updateInfosClient(oldClient, newClient);
                                client = newClient;
                            }
                        },
                        error: function () {
                            displayEchecModif();
                            updateInfosClientForm(client);
                        }
                    });
                    return false;
                }
                else {
                    displayEchecModif();
                    updateInfosClientForm(client);
                }
            }

            function getReservations() {
                if(locations == null) {
                    $.ajax({
                        type: 'post',
                        url: 'getReservations.php',
                        success: function (response) {
                            if (response !== "find:no") {
                                locations = response;
                                updateReservationsTab(JSON.parse(response));
                            }
                        },
                        error: function () {

                        }
                    });
                    return false;
                }
            }

            function addNewRow(location,id){
                var table = document.getElementById("loationsTab").getElementsByTagName('tbody')[0];
                var row = table.insertRow(table.rows.length);
                row.setAttribute("id",id);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                var dateDebut = new Date(location['dateDebut']);
                var dateFin = new Date(location['dateFin']);

                cell1.innerHTML = location['noLocation'];
                cell2.innerHTML = "du "+dateDebut.toLocaleDateString()+" au "+dateFin.toLocaleDateString();
                cell3.innerHTML = location['marque']+" "+location['modele'];
                cell4.innerHTML = location['prixLocation'];
                cell5.innerHTML = "<form method='post' target='_blank' action='creatFacture.php'>\n" +
                '<button class="btn btn-secondary" style="background-color: white"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-download-fill" viewBox="0 0 16 16">\n' +
                ' <path d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>\n' +
                '  <path d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>\n' +
                '</svg> </button>\n' +
                "<input type='hidden' name='noLocation' value='"+location['noLocation']+"'/>"+
                "</form>";
            }

            function updateReservationsTab(locations){
                if(locations.length > 0) {
                    for (var i in locations) {
                        addNewRow(locations[i],i);
                    }
                }
                else {
                    var table = document.getElementById("loationsTab").getElementsByTagName('tbody')[0];
                    var row = table.insertRow(table.rows.length);
                    var cell1 = row.insertCell(0);
                    cell1.innerHTML = "Aucune réservation";
                    cell1.colSpan = 5;
                }
            }

            function valide(email) {
                const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            }

            function validInput(){
                var noError = true;
                var form = document.getElementById("infosModifForm");
                var email = document.getElementById("mail").value;
                var number =document.getElementById("no_permis").value;
                var mdp = document.getElementById("mdp").value;

                for (i = 0; i < form.getElementsByTagName("input").length; i++) {
                    if(form.elements[i].value.length === 0){
                        noError = false;
                        break;
                    }
                }

                if(number.length < 12 || number.length>15){
                    noError = false;
                }
                if (!valide(email)) {
                    noError = false;
                }
                if(mdp ==""){
                    noError = false;
                }
                return noError;
            }
            //--></script>
    </body>
</html>