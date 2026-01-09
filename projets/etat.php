<?php
require_once "../core/guard.php";
require_once "../classes/Projet.php";

$user = Session::user();
if (!in_array($user['role'], ['admin','chef_projet'])) {
    die("Accès interdit");
}

if (!isset($_GET['id'], $_GET['etat'])) {
    die("Paramètres manquants");
}

$id = (int) $_GET['id'];
$etat = $_GET['etat'];

if (!in_array($etat, ['active','desactive'])) {
    die("Etat invalide");
}

$p = new Projet();
$p->updateEtat($id, $etat);

switch($user['role']) {
    case 'admin':
        header("Location: ../projets/projets.php");
        break;
    case 'chef_projet':
        header("Location: ../dashboard/chef.php");
        break;
}
exit;
