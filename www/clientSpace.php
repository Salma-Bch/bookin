<?php
    /**
     * \file      clientSpace.php
     * \author    Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
     * \version   1.0
     * \date      8 janvier 2020
     * \brief     Affiche l'espace personnel de l'utilisateur.
     * \details   Mes informations personnelles
     */

    use dao\DAOFactory;
    use utility\Format;

    include_once('./class/model/Client.php');
    include_once("./include/includeFiles.php");

    session_start();

    if(!isset($_SESSION['bookinClient'])){
        header('Location: ./clientLoginSpace.php');
        exit(0);
    }
    $client = $_SESSION['bookinClient'];

    $daoFactory = DAOFactory::getInstance();
    $buysDao = $daoFactory->getPurchaseDao();
    $buys = $buysDao->getClientPurchases($client->getClientId());

    $evaluatesDao = $daoFactory->getEvaluatesDao();
    $evaluates = $evaluatesDao->find(null, Format::getFormatId(8,$client->getClientId()));

    $likesDao = $daoFactory->getLikesDao();
    $likes = $likesDao->find( Format::getFormatId(8,$client->getClientId()), null);

    $booksDao = $daoFactory->getBookDao();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php
        include_once("include/head.php");
        ?>
        <title>Mon espace</title>
    </head>
    <body>
        <?php
            include_once("include/header.php");
        ?>
        <div class="container">
            <h2 id="titleName">Bonjour <?php echo $client->getFirstName()." ".$client->getLastName() ?></h2>
            <p>Bienvenue dans ton espace personnel. Tu trouvera ici toute les informations te concernant. </p>
        </div>
        <div class="container clientSpaceTable">
            <?php
                include("./include/clientInformationsTable.php");
            ?>
            <?php
                include("./include/likedCategoriesAndTagsTable.php");
            ?>
            <?php
                include("./include/buysBooksTable.php");
            ?>
            <?php
                include ("./include/likedBooksTable.php");
            ?>
            <div class="col-sm-6 col-xs-12">
                <input type="submit" class="btn modifEtDeco" id="modifButton" name="submit" value="Modifier mes informations" onclick="showModifInfosForm()" />
            </div>
            <div class="col-sm-6 col-xs-12">
                <form action="include/logout.php" method="POST">
                    <input type="submit" class="btn modifEtDeco" value="Déconnexion" />
                </form>
            </div>
            <div class="container compte" id="infosModifDiv" style="display: none;">
                <h2>Modifiez vos informations</h2>
                <div class="form-group">
                    <form id="infosModifForm">

                        <label class="col-md-12" for="client_id">Id :</label>
                        <input type="text" class="form-control col-md-12" id="client_id" required="" name="client_id" readonly="" value="<?php echo $client->getClientId();?>" />

                        <label class="col-md-12" for="last_name">Nom : </label>
                        <input type="text" class="form-control col-md-12" name="last_name" id="last_name" value="<?php echo $client->getLastName();?>" />

                        <label class="col-md-12" for="first_name">Prénom : </label>
                        <input type="text" class="form-control col-md-12" id="first_name" name="first_name" required="" value="<?php echo $client->getFirstName();?>" />

                        <label  class="col-md-12" for="mail">Adresse mail : </label>
                        <input type="text" class="form-control col-md-12" id="mail" required="" name="mail" value="<?php echo $client->getMail();?>" />

                        <label class="col-md-12" for="psd">Mot de passe :</label>
                        <input type="password" class="form-control col-md-12" id="psd" required="" name="psd" value="<?php echo $client->getPsd();?>" />

                        <label class="col-md-12" for="birth_date">Date de naissance : </label>
                        <?php
                            list($year,$month,$day) = explode("-", $client->getBirthDate()->format('Y-m-d'));
                        ?>
                        <div class="form-group col-md-4">
                            <label for="jour">Jour</label>
                            <select class="form-select form-select-lg mb-3 change" name="birthDay" aria-label="Default select example">
                                <?php
                                    echo '<option id="jour" selected="" disabled="" value="" hidden="">'.$day.'</option>' ;
                                    for ($i = 1; $i <= 31; $i++){
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="jour">Mois</label>
                            <select class="form-select form-select-lg mb-3 change" name="birthMonth" aria-label="Default select example">
                                <?php
                                    $mois = array("1" => "Janvier", "2" => "Fevrier", "3" => "Mars", "4" => "Avril", "5" => "Mai", "6" => "Juin","7" => "Juillet", "8" => "Août", "9" => "Septembre", "10" => "Octobre", "11" => "Novembre", "12" => "Décembre") ;
                                    echo '<option selected="" disabled="" value="" hidden="">'.$mois[$month].'</option>' ;
                                ?>
                                <option value="01">Janvier</option>
                                <option value="02">Fevrier</option>
                                <option value="03">Mars</option>
                                <option value="04">Avril</option>
                                <option value="05">Mai</option>
                                <option value="06">Juin</option>
                                <option value="07">Juillet</option>
                                <option value="08">Aout</option>
                                <option value="09">Septembre</option>
                                <option value="10">Octobre</option>
                                <option value="11">Novembre</option>
                                <option value="12">Decembre</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="jour">Année</label>
                            <select class="form-select form-select-lg mb-3 change" name="birthYear" aria-label="Default select example">
                                <?php
                                echo '<option selected="" disabled="" value="" hidden="">'.$year.'</option>' ;
                                $date = date('Y');
                                for($date-1; $date >= 1900; $date--){
                                    echo '<option value="'.$date.'">'.$date.'</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <label class="col-md-6" for="adresse">Profession : </label>
                        <label class="col-md-6" for="mail">Sexe :</label>

                        <div class="form-group col-md-6">
                            <select class="form-select form-select-lg mb-3 change" name="profession" aria-label="Default select example">
                                <option selected="" disabled="" value="" hidden=""><?php echo $client->getProfession()?></option>
                                <option value="Archéologue">Archéologue</option>
                                <option value="Chirurgien">Chirurgien</option>
                                <option value="Cuisinier">Cuisinier</option>
                                <option value="Dessinateur">Dessinateur</option>
                                <option value="Etudiant">Etudiant</option>
                                <option value="Ingénieur ">Ingénieur</option>
                                <option value="Journaliste">Journaliste</option>
                                <option value="Médecin">Médecin</option>
                                <option value="Peintre">Peintre</option>
                                <option value="Policier">Policier</option>
                                <option value="Professeur">Professeur</option>
                                <option value="Psychologue ">Psychologue</option>
                                <option value="Rechercheur">Rechercheur</option>
                                <option value="Rédacteur">Rédacteur</option>
                                <option value="Scientifique ">Scientifique</option>
                                <option value="Sculpteur">Sculpteur</option>
                                <option value="Sculpteur">Autres</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <select class="form-select form-select-lg mb-3 change col-md-12" name="sexe" aria-label="Default select example">
                                <option selected="" disabled="" value="" hidden=""><?php echo $client->getSex()?></option>
                                <option value="M">M</option>
                                <option value="F">F</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <button type="button" class="btn modifEtDeco" id="saveModifications" value="submit" name="submit" data-toggle="modal" data-target="#dialogModal">
                                Annuler les modifications
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn modifEtDeco" id="saveModifications" value="submit" name="submit" onclick="sendData()" data-toggle="modal" data-target="#dialogModal">
                                Enregistrer les modifications
                            </button>
                        </div>
                    </form>
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
            include("include/footer.php");
            include("include/categoryModal.php");
            include("include/tagModal.php");
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