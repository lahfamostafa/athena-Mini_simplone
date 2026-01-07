<?php
    class permission{
        public static function isAdmin(): bool{
            return Session::get('user')['role'] === 'admin';
        }
        
        public static function isChef(): bool{
            return Session::get('user')['role'] === 'chef_projet';
        }

        public static function isMembre(): bool{
            return Session::get('user')['role'] === 'membre';
        }

    }
?>