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
    if(isset($_GET['source']))
        $source = $_GET['source'];
    else
        $source = "other";

    if(isset($_GET['bookId']))
        header('Location: ./shoppingSpace.php?bookId='.$_GET['bookId'].'&source='.$source);
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
        <div class="container bodyContainer">
            <h2 id="titleName">Bonjour <?php echo $client->getFirstName()." ".$client->getLastName() ?>.</h2>
            <p>Bienvenue dans ton espace personnel. Tu trouveras ici toutes les informations te concernant. </p>
            <div class="container clientSpaceTable">
                <div class="col-md-12">
                    <h3>Informations personnelles </h3>
                </div>
                <?php
                    include("./include/clientInformationsTable.php");
                ?>
                <div class="col-md-6">
                    <h3>Catégories aimées</h3>
                </div>
                <div class="col-md-6">
                    <h3>Tags aimés</h3>
                </div>
                <?php
                    include("./include/likedCategoriesAndTagsTable.php");
                ?>
                <div class="col-md-12">
                    <h3>Livres achetés</h3>
                </div>
                <?php
                    include("./include/buysBooksTable.php");
                ?>
                <div class="col-md-12">
                    <h3>Livres aimés</h3>
                </div>
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
                            <input type="hidden" name="tags" value="tags" />
                            <label class="col-md-12" for="client_id">Id :</label>
                            <input type="text" class="form-control col-md-12" id="client_id" required="" name="client_id" readonly="" value="<?php echo Format::getFormatId(8,$client->getClientId());?>" />

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
                                <label for="birthDay">Jour</label>
                                <select class="form-select form-select-lg mb-3 change" name="birthDay" id="birthDay" aria-label="Default select example">
                                    <?php
                                        echo '<option id="jour" selected="" disabled="" value="" hidden="">'.$day.'</option>' ;
                                        for ($i = 1; $i <= 31; $i++){
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="birthMonth">Mois</label>
                                <select class="form-select form-select-lg mb-3 change" name="birthMonth" id="birthMonth" aria-label="Default select example">
                                    <?php
                                        $mois = array("01" => "Janvier", "02" => "Fevrier", "03" => "Mars", "04" => "Avril", "05" => "Mai", "06" => "Juin","07" => "Juillet", "08" => "Août", "09" => "Septembre", "10" => "Octobre", "11" => "Novembre", "12" => "Décembre") ;
                                        echo '<option selected="" disabled="" value="" hidden="">'.$mois[$month].'</option>' ;
                                    ?>
                                    <option value="01">Janvier</option>
                                    <option value="02">Février</option>
                                    <option value="03">Mars</option>
                                    <option value="04">Avril</option>
                                    <option value="05">Mai</option>
                                    <option value="06">Juin</option>
                                    <option value="07">Juillet</option>
                                    <option value="08">Août</option>
                                    <option value="09">Septembre</option>
                                    <option value="10">Octobre</option>
                                    <option value="11">Novembre</option>
                                    <option value="12">Décembre</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="birthYear">Année</label>
                                <select class="form-select form-select-lg mb-3 change" name="birthYear" id="birthYear" aria-label="Default select example">
                                    <?php
                                    echo '<option selected="" disabled="" value="" hidden="">'.$year.'</option>' ;
                                    $date = date('Y');
                                    for($date-1; $date >= 1900; $date--){
                                        echo '<option value="'.$date.'">'.$date.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <label class="col-md-6" for="profession">Profession : </label>
                            <label class="col-md-6" for="sex">Sexe :</label>

                            <div class="form-group col-md-6">
                                <select class="form-select form-select-lg mb-3 change" id="profession" name="profession" aria-label="Default select example">
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
                                <select class="form-select form-select-lg mb-3 change col-md-12" id="sex" name="sex" aria-label="Default select example">
                                    <option selected="" disabled="" value="" hidden=""><?php echo $client->getSex()?></option>
                                    <option value="M">M</option>
                                    <option value="F">F</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <button type="button" class="btn modifEtDeco" id="discardModification" value="submit" name="submit" onclick="hideModifInfosForm()" data-toggle="modal" data-target="#dialogModal">
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
        </div>
        <?php
            include("include/footer.php");
            include("include/categoryModal.php");
            include("include/tagModal.php");
        ?>
        <script><!--
            var client = <?php echo json_encode($client->toAssocArray(),JSON_INVALID_UTF8_SUBSTITUTE); ?>;
            function changeInfoClient(id, previousInformation, newInformation){
                var balise = document.getElementById(id);
                balise.textContent = balise.textContent.replace(previousInformation, newInformation);
            }

            function updateInfosClient(oldClient, newClient){
                changeInfoClient("client_id",oldClient["client_id"],newClient["client_id"]);
                changeInfoClient("last_name",oldClient["last_name"],newClient["last_name"]);
                changeInfoClient("first_name",oldClient["first_name"],newClient["first_name"]);
                changeInfoClient("mail",oldClient["mail"],newClient["mail"]);
                changeInfoClient("psd",oldClient["psd"],newClient["psd"]);
                changeInfoClient("birthDate",oldClient["birthDate"],newClient["birthDate"]);
                changeInfoClient("profession",oldClient["profession"],newClient["profession"]);
                changeInfoClient("sex",oldClient["sex"],newClient["sex"]);
                changeInfoClient("tags",oldClient["tags"],newClient["tags"]);
                updateInfosClientForm(newClient);
            }

            function updateInfosClientForm(newClient){
                document.getElementById("client_id").value = newClient["client_id"];
                document.getElementById("last_name").value = newClient["last_name"];
                document.getElementById("first_name").value = newClient["first_name"];
                document.getElementById("mail").value = newClient["mail"];
                document.getElementById("psd").value = newClient["psd"];
                document.getElementById("birthDate").value = newClient["birthDate"];
                document.getElementById("profession").value = newClient["profession"];
                document.getElementById("sex").value = newClient["sex"];
                document.getElementById("tags").value = newClient["tags"];
            }

            function showModifInfosForm() {
                document.getElementById("infosModifDiv").style.display = "block";
                infoDesabled();
            }

            function hideModifInfosForm(){
                document.getElementById("infosModifDiv").style.display = "none";
                infoEnabled();
            }

            function infoEnabled(){
                var element = document.getElementById('tableauInfo') ;
                element.style.background ='white';
                element.style.opacity='1';
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
                if (validInput2()) {
                    var formData = $("#infosModifForm").serialize();
                    $.ajax({
                        type: 'post',
                        url: './include/updateClientData.php',
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
                            //displayEchecModif();
                            //updateInfosClientForm(client);
                        }
                    });
                    return false;
                }
                else {
                    alert("pb");
                    //displayEchecModif();
                    //updateInfosClientForm(client);
                }
            }

            function valide3(email) {
                const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            }

            function validInput2(){
                var noError = true;
                var form = document.getElementById("infosModifForm");
             // var mail = document.getElementById("mail").value;
             // var psd = document.getElementById("psd");

                for (var i = 0; i < form.getElementsByTagName("input").length; i++) {
                    if(form.elements[i].value.length === 0){
                        noError = false;
                        break;
                    }
                }

             /*   if (!valide3(mail)) {
                    noError = false;
                }
                if(validPassword2(psd)){
                    noError = false;
                }*/
                return noError;
            }
            //--></script>
    </body>
</html>