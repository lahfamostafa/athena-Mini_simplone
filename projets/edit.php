<?php
require_once "../includes/header.php";
require_once "../core/guard.php";
require_once "../classes/Projet.php";
require_once "../classes/User.php";

$user = Session::user();
if (!in_array($user['role'], ['admin','chef_projet'])) {
    die("Accès interdit");
}

if (!isset($_GET['id'])) {
    die("Paramètres manquants");
}

$p = new Projet();
$pr = $p->findById((int)$_GET['id']);

$u = new User();
$chefs = array_filter($u->getAll(), fn($usr) => $usr['roleUser'] === 'chef_projet');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stm = $p->db->prepare("
        UPDATE projet SET titre = ?, descriptionP = ?, date_debut = ?, date_fin = ?, idUser = ? WHERE id = ?
    ");
    $stm->execute([
        $_POST['titre'],
        $_POST['descriptionP'],
        $_POST['date_debut'],
        $_POST['date_fin'],
        $_POST['idUser'],
        $pr['id']
    ]);

    header("Location: ../dashboard/chef.php");
    exit;
}
?>

<h1>Modifier projet</h1>
<form method="POST">
    <input type="text" name="titre" value="<?= $pr['titre'] ?>" required><br>
    <textarea name="descriptionP" required><?= $pr['descriptionP'] ?></textarea><br>
    <input type="date" name="date_debut" value="<?= $pr['date_debut'] ?>" required><br>
    <input type="date" name="date_fin" value="<?= $pr['date_fin'] ?>" required><br>

    <select name="idUser" required>
        <?php foreach($chefs as $c): ?>
            <option value="<?= $c['id'] ?>" <?= $c['id'] == $pr['idUser'] ? 'selected' : '' ?>>
                <?= $c['nom'] . " " . $c['prenom'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <button>Modifier</button>
</form>
