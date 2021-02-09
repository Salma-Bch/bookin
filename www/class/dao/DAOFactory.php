<?php


use dao\exception\DAOConfigurationException;

class DAOFactory {

    private const FILE_PROPERTIES = "dao.properties";
    private const PROPERTY_HOST = "host";
    private const PROPERTY_DRIVER = "driver";
    private const PROPERTY_PORT = "port";
    private const PROPERTY_DATA_BASE_NAME = "dbname";
    private const PROPERTY_USER_NAME = "userName";
    private const PROPERTY_PASSWORD = "password";

    private String $url;
    private String $userName;
    private String $password;

    public function __construct($url, $userName, $password){
        $this->url = $url;
        $this->userName = $userName;
        $this->password = $password;
    }

    public static function getInstance(): DAOFactory{
        $file = DAOFactory::FILE_PROPERTIES;
        //Recuperation des parametre present dans le fichier
        if (!$parametre = parse_ini_file($file, TRUE))
            throw new DAOConfigurationException('Le fichier est introuvable' . $file . '.');

        $url = $parametre['database'][DAOFactory::PROPERTY_DRIVER] .
            ':host=' . $parametre['database'][DAOFactory::PROPERTY_HOST];
        if (!empty($parametre['database'][DAOFactory::PROPERTY_PORT]))
            $url = $url . ";port=" . $parametre["database"][DAOFactory::PROPERTY_PORT];
        $url = $url . ";dbname=" . $parametre['database'][DAOFactory::PROPERTY_DATA_BASE_NAME];
        $userName = $parametre['database'][DAOFactory::PROPERTY_USER_NAME];
        $password = $parametre['database'][DAOFactory::PROPERTY_PASSWORD];

        return new DAOFactory($url, $userName, $password);
    }

    public function getConnection(): PDO{
        return new PDO($this->url, $this->userName, $this->password);
    }

    public function getClientDao(){ return new ClientDaoImpl(this); }
}