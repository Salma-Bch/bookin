<?php

namespace dao\object;

use model\Administrator;

interface AdministratorDao {
    function create(Administrator $administrator): bool;
    function find(String $mail, String $password): Administrator;
    function update(Administrator $administrator): bool;

}