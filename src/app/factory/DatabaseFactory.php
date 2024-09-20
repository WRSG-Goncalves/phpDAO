<?php

namespace Wrsg\App\factory;

use Wrsg\App\repository\dbMysql;

class DatabaseFactory
{
    public static function create(): dbMysql
    {
        return new dbMysql();
    }
}
