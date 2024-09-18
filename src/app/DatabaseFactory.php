<?php

namespace Wrsg\App;

class DatabaseFactory
{
    public static function create(): DatabaseConnection
    {
        return new DatabaseConnection();
    }
}
