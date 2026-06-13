<?php

namespace Classes;

use Config\DBConnection;
use PDO;

class FileController
{
    function getAll(): array|null
    {
        $connection = DBConnection::$connection;

        $sql = "SELECT * FROM files ORDER BY id DESC";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $logs;
    }

    function fetch($slug)
    {
        $connection = DBConnection::$connection;

        $sql = "SELECT * FROM files WHERE slug = :slug";
        $stmt = $connection->prepare($sql);
        $stmt->execute([
            'slug' => $slug
        ]);

        $log = $stmt->fetch(PDO::FETCH_ASSOC);

        return $log;
    }

    function incrementDownload($id): void
    {
        $connection = DBConnection::$connection;

        $sql = "UPDATE files
        SET downloads = downloads + 1
        WHERE id = :id";

        $stmt = $connection->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
    }
}