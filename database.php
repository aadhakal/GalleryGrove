<?php
class Database {
    private static $mysqli = null;

    public static function dbConnect() {
        require_once("/home/adhakal3/DBdhakal.php");

        if ($mysqli == null) {
            try {
                $mysqli = new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME, USERNAME, PASSWORD);
                echo "Successful Connection";
            } catch (PDOException $e) {
                echo "Could not connect";
                die($e->getMessage());
            }
        }
        return $mysqli;
    }
}
?>
