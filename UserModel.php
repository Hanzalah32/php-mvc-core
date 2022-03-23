<?php

namespace anzalahmvc\core;

use anzalahmvc\core\db\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
}