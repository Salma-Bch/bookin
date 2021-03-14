<?php
    use dao\DAOFactory;
    use model\Client;

    include_once('../class/dao/DAOFactory.php');
    include_once('../class/dao/object/ClientDao.php');
    include_once('../class/dao/object/ClientDaoImpl.php');
    include_once('../class/model/Client.php');
    include_once('../class/dao/DAOUtility.php');
    include_once('../class/dao/exception/DAOException.php');
    session_start();

    if(isset($_POST['lastName'], $_POST['firstName'], $_POST['mail'], $_POST['psd'], $_POST['birthDay'], $_POST['birthMonth'],
        $_POST['birthYear'], $_POST['profession'], $_POST['sex'])){
        try {
            $birthDate = new DateTime($_POST['birthDay'] . "-" . $_POST['birthMonth'] . "-" .
                $_POST['birthYear']);
        } catch (Exception $e) {
            echo "creation failed ".$e;
            exit(-1);
        }
        $categories = array();
        if(isset($_POST['category'])){
            foreach ($_POST['category'] as $category){
                array_push($categories, $category);
            }
        }

        $tags = array();
        if(isset($_POST['tags'])){
            foreach ($_POST['tags'] as $tag){
                array_push($tags, $tag);
            }
        }
        $daoFactory = DAOFactory::getInstance();
        $clientDao = $daoFactory->getClientDao();
        $clientID = $clientDao->getMaxId()+1;
        $clientID = str_pad(($clientID),8,0, STR_PAD_LEFT);
        $client = new Client($clientID, $_POST['lastName'], $_POST['firstName'], $_POST['mail'], $_POST['psd'], $birthDate,$_POST['profession'],
            $_POST['sex'],$tags);
        if( $clientDao->create($client) ) {
            echo "creation successfull";
            $_SESSION['bookinClient'] = $client;
            exit(0);
        }
    }
    echo "creation failed";
    exit(-1);


