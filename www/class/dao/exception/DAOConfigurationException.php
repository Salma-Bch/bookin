<?php


namespace dao\exception;


class DAOConfigurationException extends \RuntimeException {

    public function __construct(String $message = null, \Throwable $cause = null) { parent::__construct($message, $cause);}

}