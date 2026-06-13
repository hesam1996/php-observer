<?php

namespace Config;

use PDO;
use PDOException;

class DBConnection
{
    private string $localhost = "localhost";
    private string $username = "root";
    private string $password = "";
    private string $database = "php_observer";

    public static ?PDO $connection = null;

    public function __construct()
    {
        if (self::$connection === null) {
            try {
                $dsn = "mysql:host={$this->localhost};dbname={$this->database};charset=utf8mb4";

                self::$connection = new PDO($dsn, $this->username, $this->password);

                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
}