<?php
require_once "../core/guard.php";
require_once "../classes/Projet.php";
require_once "../classes/User.php";

$user = Session::user();

if (!in_array($user['role'], ['admin','chef_projet'])) {
    die("Accès interdit");
}

$u = new User();
$users = $u->getAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $p = new Projet();
    $p->create(
        $_POST['titre'],
        $_POST['descriptionP'],
        $_POST['date_debut'],
        $_POST['date_fin'],
        $_POST['idUser']
    );
    header("Location: index.php");
    exit;
}
?>
<form method="POST">
    <input type="text" name="titre" placeholder="Titre" required><br>
    <textarea name="descriptionP" placeholder="Description" required></textarea><br>
    <input type="date" name="date_debut" required><br>
    <input type="date" name="date_fin" required><br>

    <select name="idUser" required>
        <?php foreach($users as $usr): ?>
            <?php if($usr['roleUser'] === 'chef_projet'): ?>
                <option value="<?= $usr['id'] ?>">
                    <?= $usr['nom'] . " " . $usr['prenom'] ?>
                </option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select><br>

    <button>Créer projet</button>
</form>
