<?php
include ("./relatifIncludeFiles.php");
try {
    if (isset($_POST['bookId'], $_POST['clientId'], $_POST['satisfied'])) {
        $evaluatesDao = \dao\DAOFactory::getInstance()->getEvaluatesDao();
        $evaluates = new \model\Evaluates($_POST['clientId'], $_POST['bookId'], $_POST['satisfied'] == "true");
        $created = $evaluatesDao->create($evaluates);
        if (!$created) {
            echo "failed";
            exit(-1);
        }
        echo "success";
        exit(0);
    }
}
catch(Exception $e){
    echo "failed";
    exit(-1);
}
echo "failed";
exit(-1);