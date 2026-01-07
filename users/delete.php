<?php
    require_once "../core/guard.php";
    require_once "../classes/user.php";

    Session::start();
    $user = Session::user();

    if(!$user || $user['role'] !== 'admin'){
        die("Acces interdit");
    }

    if(!isset($_GET['id'])){
        die("ID utilasateur manquant");
    }
     
    $id = $_GET['id'];

    $u = new User();

    try {
        $u->delete($id);
        header("Location: index.php");
        exit;
    } catch (Exception $e) {
        echo "Erreur: " . $e->getMessage();
    }
?>