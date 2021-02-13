<?php
    use dao\DAOFactory;
use model\Client;

    include_once('../../class/dao/DAOFactory.php');
    include_once('../../class/dao/object/ClientDao.php');
    include_once('../../class/dao/object/ClientDaoImpl.php');
    include_once('../../class/model/Client.php');
    include_once('../../class/dao/DAOUtility.php');
    include_once('../../class/dao/exception/DAOException.php');

    if(isset($_POST['lastName'], $_POST['firstName'], $_POST['mail'], $_POST['psd'], $_POST['birthDay'], $_POST['birthMonth'],
        $_POST['birthYear'], $_POST['profession'], $_POST['sex'])){
        try {
            $birthDate = new DateTime($_POST['birthDay'] . "-" . $_POST['birthMonth'] . "-" .
                $_POST['birthYear']);
        } catch (Exception $e) {
            echo "creation failed";
            exit(-1);
        }
        $daoFactory = DAOFactory::getInstance();
        $clientDao = $daoFactory->getClientDao();
        $client = new Client(111, $_POST['lastName'], $_POST['firstName'], $_POST['mail'], $_POST['psd'], $birthDate,$_POST['profession'],$_POST['sex'],0);
        if( $clientDao->create($client) ) {
            echo "creation successfull";
            exit(0);
        }
    }
    echo "creation failed";
    exit(-1);

