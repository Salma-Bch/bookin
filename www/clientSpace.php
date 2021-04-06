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
                                $month = intval($month);
                            ?>
                            <div class="form-group col-md-4">
                                <label for="birthDay">Jour</label>
                                <select class="form-select form-select-lg mb-3 change" name="birthDay" id="birthDay" aria-label="Default select example">
                                    <?php
                                        for ($i = 1; $i <= 31; $i++){
                                            if($i == $day)
                                                echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
                                            else
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="birthMonth">Mois</label>
                                <select class="form-select form-select-lg mb-3 change" name="birthMonth" id="birthMonth" aria-label="Default select example">
                                    <?php
                                        $mois = array("1" => "Janvier", "2" => "Fevrier", "3" => "Mars", "4" => "Avril",
                                            "5" => "Mai", "6" => "Juin","7" => "Juillet", "8" => "Août", "9" => "Septembre",
                                            "10" => "Octobre", "11" => "Novembre", "12" => "Décembre") ;
                                        for ($i = 1; $i <= 12; $i++){
                                            if($i == $month)
                                                echo '<option value="'.$i.'" selected="selected">'.$mois[$i].'</option>';
                                            else
                                                echo '<option value="'.$i.'">'.$mois[$i].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="birthYear">Année</label>
                                <select class="form-select form-select-lg mb-3 change" name="birthYear" id="birthYear" aria-label="Default select example">
                                    <?php
                                    $date = date('Y');
                                    for($date-1; $date >= 1900; $date--){
                                        if($date == $year)
                                            echo '<option value="'.$date.'" selected="selected">'.$date.'</option>';
                                        else
                                            echo '<option value="'.$date.'">'.$date.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <label class="col-md-6" for="profession">Profession : </label>
                            <label class="col-md-6" for="sex">Sexe :</label>

                            <div class="form-group col-md-6">
                                <select class="form-select form-select-lg mb-3 change" id="profession" name="profession" aria-label="Default select example">
                                    <?php
                                        $professions = array("Archéologue","Chirurgien","Cuisinier","Dessinateur",
                                            "Etudiant","Ingénieur","Journaliste","Médecin","Peintre","Policier",
                                            "Professeur","Psychologue","Rechercheur","Rédacteur","Scientifique",
                                            "Sculpteur","Autres");

                                        for($i=0; $i< 17; $i++){
                                            if($professions[$i] == $client->getProfession())
                                                echo '<option selected="selected" value="'.$client->getProfession().'" >'.$client->getProfession().'</option>';
                                            else
                                                echo '<option value="'.$professions[$i].'" >'.$professions[$i].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <select class="form-select form-select-lg mb-3 change col-md-12" id="sex" name="sex" aria-label="Default select example">
                                    <?php
                                        $sexs = array("M","F") ;

                                    for($i=0; $i< 2; $i++){
                                        if($sexs[$i] == $client->getSex())
                                            echo '<option selected="selected" value="'.$client->getSex().'" >'.$client->getSex().'</option>';
                                        else
                                            echo '<option value="'.$sexs[$i].'" >'.$sexs[$i].'</option>';
                                    }
                                    ?>
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
        </div>
        <?php
            include("include/footer.php");
            include("include/categoryModal.php");
            include("include/tagModal.php");
            include("include/dialogModal.php");
        ?>
        <script><!--
            var client = <?php echo json_encode($client->toAssocArray(),JSON_INVALID_UTF8_SUBSTITUTE); ?>;
            function changeInfoClient(id, previousInformation, newInformation){
                var balise = document.getElementById(id);
                balise.textContent = balise.textContent.replace(previousInformation, newInformation);
            }


            function updateInfosClient(oldClient, newClient){
                changeInfoClient("titleName",oldClient["first_name"]+" "+oldClient['last_name'],newClient["first_name"]+" "+newClient['last_name']);
                changeInfoClient("tab_id",oldClient["client_id"],newClient["client_id"]);
                changeInfoClient("tab_laste_name",oldClient["last_name"],newClient["last_name"]);
                changeInfoClient("tab_first_name",oldClient["first_name"],newClient["first_name"]);
                changeInfoClient("tab_mail",oldClient["mail"],newClient["mail"]);
                changeInfoClient("psd",oldClient["psd"],newClient["psd"]);
                changeInfoClient("tab_profession",oldClient["profession"],newClient["profession"]);
                changeInfoClient("tab_sex",oldClient["sex"],newClient["sex"]);
                updateInfosClientForm(newClient);
            }

            function updateInfosClientForm(newClient){
                var newBirthDate = newClient['birthDate'].split('-');
                document.getElementById("client_id").value = newClient["client_id"];
                document.getElementById("last_name").value = newClient["last_name"];
                document.getElementById("first_name").value = newClient["first_name"];
                document.getElementById("mail").value = newClient["mail"];
                document.getElementById("psd").value = newClient["psd"];
                document.getElementById("birthDay").value = parseInt(newBirthDate[2]);
                document.getElementById("birthMonth").value = parseInt(newBirthDate[1]);
                document.getElementById("birthYear").value = newBirthDate[0];
                document.getElementById("profession").value = newClient["profession"];
                document.getElementById("sex").value = newClient["sex"];
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
                document.getElementById("modalTitle").textContent = "Modification de vos informations personnelles";
                document.getElementById("textModal").textContent = "Vos informations personnelles ont été mises à jour.";
                document.getElementById("modifFailedIcon").setAttribute("display", "none");
                document.getElementById("modifCheckedIcon").setAttribute("fill", "green") ;
                document.getElementById("modifCheckedIcon").setAttribute("display", "inline-block");
                var myModal = new bootstrap.Modal(document.getElementById('dialogModal'));
                myModal.show();
            }

            function displayEchecModif(){
                document.getElementById("modalTitle").textContent = "Modification de vos informations personnelles";
                document.getElementById("textModal").textContent = "Vos informations personnelles n'ont pas été mises à jour.";
                document.getElementById("modifFailedIcon").setAttribute("fill", "red");
                document.getElementById("modifCheckedIcon").setAttribute("display", "none");
                document.getElementById("modifFailedIcon").setAttribute("display", "inline-block");
                var myModal = new bootstrap.Modal(document.getElementById('dialogModal'));
                myModal.show();
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
                                hideModifInfosForm();
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