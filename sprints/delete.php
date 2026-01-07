<?php
require_once "../classes/Sprint.php";

$id = (int) $_GET['id'];
$idProjet = $_GET['idProjet'];

$s = new Sprint();
$s->delete($id);

header("Location: index.php?idProjet=$idProjet");
exit;

?>