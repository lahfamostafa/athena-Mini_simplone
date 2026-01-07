<?php
require_once "../core/guard.php";
require_once "../classes/Projet.php";

Session::start();
$user = Session::user();

if(!$user || $user['role'] !== 'chef_projet'){
    die("Accès interdit");
}

$projetModel = new Projet();
$projets = $projetModel->getByChefProjet($user['id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes projets</title>
</head>
<body>

<h1> Mes projets</h1>

<a href="create.php">Nouveau projet</a>

<br><br>

<?php if(empty($projets)): ?>
    <p>Aucun projet pour le moment.</p>
<?php else: ?>

<table>
    <tr>
        <th>Titre</th>
        <th>Description</th>
        <th>Date début</th>
        <th>Date fin</th>
        <th>Etat</th>
        <th>Actions</th>
    </tr>

    <?php foreach($projets as $p): ?>
    <tr>
        <td><?= htmlspecialchars($p['titre']) ?></td>
        <td><?= htmlspecialchars($p['descriptionP']) ?></td>
        <td><?= $p['date_debut'] ?></td>
        <td><?= $p['date_fin'] ?></td>
        <td><?= $p['etat'] ?></td>
        <td>
            <a href="../sprint/index.php?idProjet=<?= $p['id'] ?>">Sprints</a> |
            <a href="edit.php?id=<?= $p['id'] ?>">Modifier</a> |
            <a href="delete.php?id=<?= $p['id'] ?>"
               onclick="return confirm('Supprimer ce projet ?')">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php endif; ?>

</body>
</html>
