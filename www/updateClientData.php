<?php
/**
 * \file      updateClientData.php
 * \author    Salma BENCHELKHA - Mouncif LEKMITI - Enzo CERINI
 * \version   1.0
 * \date      8 janvier 2020
 * \brief     Permet la modification des données du client dans la base de données.
 * \details   Connexion à la base de données.
 */

include_once("./include/includeFiles.php");

session_start();

try {
    $clientDao = DAOFactory::getInstance()->getClientDao();
    $client = new Client($_POST['client_id'], $_POST['last_name'], $_POST['first_name'], $_POST['mail'], $_POST['psd'], $_POST['$birthDate'], $_POST['$profession'], $_POST['$sex'], $_POST['tags']);
    $clientDao->update($client);
    if (!isset($client)) {
        echo "maj:no";
    }
    else {
        $_SESSION['client'] = $client;
        echo json_encode($_SESSION['client']->toAssocArray(),JSON_INVALID_UTF8_SUBSTITUTE);
    }
}
catch (Exception $e) {
    echo "maj:no";
}



