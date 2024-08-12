<?php
class Database{
    private static $pdo = null;

    //conexion a la base de datos latienda
    public static function connect(){
        if(self::$pdo === null){
            $host = "localhost";
            $db = "latienda";
            $user = "root";
            $pass = "";
            $charset = "utf8mb4";

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  
            ];

            try {
                self::$pdo = new PDO($dsn, $user, $pass, $options);
;            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        }
        return self::$pdo;
    }
}
?>