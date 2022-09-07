<?php

declare(strict_types=1);

namespace EcoNote\src;

use PDO;
use PDOException;
use EcoNote\src\interfaces\IConnectionDB;

class MySqlConnection implements IConnectionDB
{
    private const DB_CONFIG = [

        'host' => 'localhost',
        'database' => 'note_db',
        'user' => 'root',
        'password' => 'usbw'
    ];

    public function getConnection(): PDO
    {
        try {
            $dsn = "mysql:host=" . static::DB_CONFIG['host'] . ";dbname=" . static::DB_CONFIG['database'];
            return (new PDO($dsn, static::DB_CONFIG['user'], static::DB_CONFIG['password']));
        } catch (PDOException $e) {
            header('Location: /econote/500_problems.php');
            exit();
        }
    }
}