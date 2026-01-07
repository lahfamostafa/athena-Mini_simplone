<?php
    require_once "../core/guard.php";
    require_once "../classes/user.php";

    $user = Session::user();

    function alert($message){
        $_SESSION['alert'] = $message;
        header("Location: index.php");
        exit;
    }

    if(!$user || $user['role'] !== 'admin'){
        alert("Acces interdit");
    }

    if(!isset($_GET['id'],$_GET['etat'])){
        alert("Paramètres manquants");
    }

    $id = (int) $_GET['id'];
    $etat = $_GET['etat'];
    $role = $_GET['role'];

    if(!in_array($etat , ['active', 'desactive'])){
        alert("Etat invalide");
    }

    if($role === 'admin'){
        alert("Tu ne peu pas modifier l'etat d'admin");
    }

    $userModel = new User();
    $userModel->updateEtat($id, $etat);
    alert("Etat modifié avec succès");
?>