<?php
require_once "../core/guard.php";
require_once "../classes/Projet.php";

$user = Session::user();
if (!in_array($user['role'], ['admin','chef_projet'])) {
    die("Accès interdit");
}

if (!isset($_GET['id'])) {
    die("Paramètres manquants");
}

$id = (int) $_GET['id'];
$p = new Projet();
$p->delete($id);

header("Location: index.php");
exit;
