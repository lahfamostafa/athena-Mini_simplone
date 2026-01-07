<?php
    require_once "../core/guard.php";
    require_once "../classes/user.php";

    Session::start();
    $user = Session::user();

    if(!$user || $user['role'] !== 'admin'){
        die("Acces interdit");
    }

    if(!isset($_GET['id'],$_GET['etat'])){
        die("Paramètres manquants");
    }

    $id = (int) $_GET['id'];
    $etat = $_GET['etat'];

    if(!in_array($etat , ['active', 'desactive'])){
        die("Etat invalide");
    }

    $userModel = new User();
    $userModel->updateEtat($id, $etat);
    header("Location: index.php");
    exit;
?>