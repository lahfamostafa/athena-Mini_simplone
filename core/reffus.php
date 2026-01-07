<?php
    class refus{
        public static function auth(){
            Session::start();
            if(!auth::check()){
                header("Location: login.php");
                exit;
            }
        }

        public static function admin(){
            self::auth();
            if(!permission::isAdmin())
                die("Accès admin refusé");
        }

        public static function chef(){
            self::auth();
            if(!permission::isAdmin() && !permission::isChef())
                die("Accès chef de projet refusé");
        }

        public static function membre(){
            self::auth();
        }
    }
?>