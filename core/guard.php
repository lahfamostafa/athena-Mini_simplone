<?php
require_once __DIR__ . "/Session.php";

Session::start();

if (!Session::check()) {
    header("Location: ../public/login.php");
    exit;
}
