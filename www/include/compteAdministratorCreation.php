<?php
    use dao\DAOFactory;
    use model\Administrator;

    include_once('../class/dao/DAOFactory.php');
    include_once('../class/dao/object/AdministratorDao.php');
    include_once('../class/dao/object/AdministratorDaoImpl.php');
    include_once('../class/model/Administrator.php');
    include_once('../class/dao/DAOUtility.php');
    include_once('../class/dao/exception/DAOException.php');
    include_once('../class/utility/Format.php');
    session_start();

    if(isset($_POST['lastName'], $_POST['firstName'], $_POST['mail'], $_POST['psd'])){
        try {
            $daoFactory = DAOFactory::getInstance();
            $administratorDao = $daoFactory->getAdministratorDao();
            $administratorID = $administratorDao->getMaxId()+1;
            $administratorID = str_pad(($administratorID),8,0, STR_PAD_LEFT);
            $administrator = new Administrator($administratorID, $_POST['lastName'], $_POST['firstName'], $_POST['mail'], $_POST['psd']);
            if( $administratorDao->create($administrator) ) {
                echo "creation successfull";
                $_SESSION['bookinAdministrator'] = $administrator;
                exit(0);
            }

            echo "creation failed";
            exit(-1);
        } catch (Exception $e) {
            echo "creation failed " . $e;
            exit(-1);
        }
}


