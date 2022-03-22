<?php
    abstract class DB {
        private static $conn;

        private static function getConfig(){
            // get config file
            return parse_ini_file(__DIR__ . "/../config/config.ini");
        }
        

        public static function getInstance() {
            if(self::$conn != null) {
                // Reuse connection
                return self::$conn;
            }
            else {
                // get the config for new connection
                $config = self::getConfig();
                $host = $config['db_host'];
                $database = $config['db_name'];
                $user = $config['db_user'];
                $password = $config['db_password'];
                
                // Setup a new connection
                self::$conn = new PDO('mysql:host='.$host.';dbname='.$database.';charset=utf8mb4', $user, $password);
                return self::$conn;
            }
        }
    }