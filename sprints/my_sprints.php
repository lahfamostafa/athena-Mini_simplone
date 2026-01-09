<?php
require_once "../core/Session.php";
require_once "../classes/Projet.php";
require_once "../classes/Sprint.php";

Session::start();
$user = Session::user();

if (!$user) {
    header("Location: ../public/login.php");
    exit;
}

$sprintModel = new Sprint();
$projetModel = new Projet();

if ($user['role'] === 'chef_projet') {
    $projets = $projetModel->getByChefProjet($user['id']);
} elseif ($user['role'] === 'membre') {
    $projets = $projetModel->getActiveProjects(); // méthode à créer qui renvoie projets actifs
} else {
    die("Accès interdit");
}

$sprints = [];
foreach ($projets as $p) {
    $sprintsProjet = $sprintModel->getByProject($p['id']); // méthode qui retourne sprints d'un projet
    foreach ($sprintsProjet as $s) {
        $s['projet'] = $p['titre']; // ajouter le titre du projet
        $sprints[] = $s;
    }
}
?>

<h1>Mes Sprints</h1>

<?php if ($user['role'] === 'chef_projet'): ?>
    <a href="../sprints/create.php">Nouveau sprint</a>
<?php endif; ?>

<table cellpadding="8" cellspacing="0">
<tr>
    <th>Projet</th>
    <th>Nom du sprint</th>
    <th>Date début</th>
    <th>Date fin</th>
    <th>Etat</th>
    <?php if ($user['role'] === 'chef_projet'): ?>
        <th>Actions</th>
    <?php endif; ?>
</tr>

<?php foreach ($sprints as $s): ?>
<tr>
    <td><?= htmlspecialchars($s['projet']) ?></td>
    <td><?= htmlspecialchars($s['nomSprint']) ?></td>
    <td><?= $s['date_debut'] ?></td>
    <td><?= $s['date_fin'] ?></td>
    <td><?= $s['etat'] ?></td>
    <?php if ($user['role'] === 'chef_projet'): ?>
    <td>
        <a href="edit.php?id=<?= $s['id'] ?>">Modifier</a> |
        <a href="delete.php?id=<?= $s['id'] ?>" onclick="return confirm('Supprimer ce sprint ?')">Supprimer</a>
    </td>
    <?php endif; ?>
</tr>
<?php endforeach; ?>
</table>
