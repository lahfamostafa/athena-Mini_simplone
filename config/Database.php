<?php
    class Database{
        public static ?PDO $conn = null;
        public static function connect(){
            if(self::$conn === null){
                try{
                    self::$conn = new PDO("mysql:host=localhost;dbname=athena;charset=utf8mb4", "root","",[
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES   => true
                    ]);
                }catch(PDOException $e){
                    echo "error de connection : " . $e->getMessage();
                }
            }
            return self::$conn;
        }
    }
?>