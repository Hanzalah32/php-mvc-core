<?php

namespace anzalahmvc\core;

use anzalahMvc\Core\db\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
}