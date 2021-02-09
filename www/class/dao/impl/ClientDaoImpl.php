<?php


class ClientDaoImpl {
    private const SQL_SELECT_BY_CLIENT_ID = "SELECT client_id, last_name, first_name, mail, psd, birth_date, profession, sex, client_money FROM client WHERE client_id = ?";
    private const SQL_SELECT_BY_MAIL = "SELECT client_id, last_name, first_name, mail, psd, birth_date, profession, sex, client_money FROM client WHERE mail = ?";
    private const SQL_INSERT = "INSERT INTO client (client_id, last_name, first_name, mail, psd, birth_date, profession, sex, client_money) VALUES (?, ? ,? ,? ,? ,? ,?, ?, ?)";
    private const SQL_UPDATE = "UPDATE clients SET last_name=?, first_name=?, mail=?, psd=?, birth_date=?, profession=?, sex=?, client_money=? WHERE client_id=?";

    public function find(String $mail){

    }

}