<?php
require_once "../classes/Sprint.php";

$idProjet = (int) $_GET['idProjet'];

if($_SERVER['REQUEST_METHOD']==='POST'){
    $s = new Sprint();
    $s->create(
        $_POST['nom'],
        $_POST['date_debut'],
        $_POST['date_fin'],
        $idProjet
    );
    header("Location: index.php?idProjet=$idProjet");
    exit;
}
?>

<form method="POST">
    <input type="text" name="nom" placeholder="Nom sprint" required><br>
    <input type="date" name="date_debut" required><br>
    <input type="date" name="date_fin" required><br>
    <button>Créer</button>
</form>
