<?php
require_once('../vendor/autoload.php');
$dotenv = new Dotenv\Dotenv('../');
$dotenv->load();

class Database {
        private static $instance = NULL;
        private function __construct() {}
        private function __clone() {}

public static function getInstance() {
        //hardcoded values need to change later
        if(!isset(self::$instance)){
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instance = new PDO("mysql:host=" . getenv(DB_HOST) . ";dbname=" . getenv(DB_NAME) , getenv(DB_USER), getenv(DB_PASS));
        }
    return self::$instance;
    }
}
?>
