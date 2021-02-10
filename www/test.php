<?php



include("./classproject/model/Client.php");
use model\Client;

$client = new Client(1234,"Fname","Lname","mail","psd",new DateTime("2000-02-05"),
    "prof","M",123);

echo $client->getAge() ;
