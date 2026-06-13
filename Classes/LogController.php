<?php

namespace Classes;

use Config\DBConnection;
use PDO;

class LogController
{
    function getAll(): array|null
    {
        $connection = DBConnection::$connection;

        $sql = "SELECT * FROM logs ORDER BY id DESC";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $logs;
    }

    public static function store(string $message, string $creator, string $ip): void
    {
        $connection = DBConnection::$connection;

        $sql = "INSERT INTO logs (creator, msg, ip) VALUES (:creator, :msg, :ip)";

        $stmt = $connection->prepare($sql);

        $stmt->execute([
            'creator' => $creator,
            'msg' => $message,
            'ip' => $ip,
        ]);
    }
}