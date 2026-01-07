<?php
require_once "../classes/Sprint.php";

$id = (int) $_GET['id'];
$etat = $_GET['etat'];
$idProjet = $_GET['idProjet'];

$s = new Sprint();
$s->updateEtat($id,$etat);

header("Location: index.php?idProjet=$idProjet");
exit;

?>