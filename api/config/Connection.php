<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
ini_set('display_errors', '0');
date_default_timezone_set("Asia/Manila");
set_time_limit(1000);

define("SERVER", "localhost");
define("DBASE", "sample");
define("USER", "root");
define("PASSWORD", "");
    
class Connection {
    private $conString = "mysql:host=".SERVER.";dbname=".DBASE.";charset=utf8mb4";
    private $options = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES => false,
        \PDO::ATTR_STRINGIFY_FETCHES => false
    ];

    public function connect() {
        $conn = false;
        try {
            $conn = new \PDO($this->conString, USER, PASSWORD, $this->options);
        } catch (\Throwable $th) {
            echo "Connection error: " . $exception->getMessage();//throw $th;
        }
        return $conn;
    }
}