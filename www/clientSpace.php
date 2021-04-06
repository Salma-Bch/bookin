<?php
/**
 * @File        clientSpace.php
 * @package     www
 * @Author      Salma BENCHELKHA - Mouncif LEKMITI - Farah MANOUBI
 * @Version     1.0
 * @Date        05/04/2021
 * @Brief       Espace personnel du client.
 * @Details     Permet l'affichage des informations personnelles du client, son historique d'achat et ses évaluations.
 *              Le client a également la possibilité de modifier ses informations et de se déconnecter.
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
                <?php
                    include("./include/clientTables.php");
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
            include("include/clientModals.php");
            include("include/dialogModal.php");
        ?>
        <script><!--
            var client = <?php echo json_encode($client->toAssocArray(),JSON_INVALID_UTF8_SUBSTITUTE); ?>;

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
            //--></script>
    </body>
</html>