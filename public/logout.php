<?php
require_once "../core/Session.php";
Session::start();
Session::destroy();
header("Location: login.php");
