<?php

class Connection {
    private static $connection;

    public static function getConnection() {
        if (!isset(self::$connection)) {
            $host = 'localhost';
            $user = 'gabriel';
            $password = '729369';
            $database = 'saperx';

            try {
                self::$connection = new PDO("mysql:host=$host;dbname=$database", $user, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                die("Erro ao conectar ao banco de dados: " . $e->getMessage());
            }
        }

        return self::$connection;
    }
}