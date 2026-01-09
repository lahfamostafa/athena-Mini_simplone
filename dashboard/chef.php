<?php
require_once "../includes/header.php";
require_once "../core/guard.php";
require_once "../classes/Projet.php";

$user = Session::user();

if(!$user || $user['role'] !== 'chef_projet'){
    die("Accès interdit");
}

$projetModel = new Projet();
$projets = $projetModel->getByChefProjet($user['id']);
?>

<h1>Mes Projets</h1>

<a href="../projets/create.php">Nouveau projet</a>

<table>
<tr>
    <th>Titre</th>
    <th>Description</th>
    <th>Début</th>
    <th>Fin</th>
    <th>Etat</th>
    <th>Actions</th>
</tr>

<?php foreach($projets as $p): ?>
<tr>
    <td><?= $p['titre'] ?></td>
    <td><?= $p['descriptionP'] ?></td>
    <td><?= $p['date_debut'] ?></td>
    <td><?= $p['date_fin'] ?></td>
    <td><?= $p['etat'] ?></td>
    <td>
        <a href="../sprints/index.php?idProjet=<?= $p['id'] ?>">Voir Sprints</a> |
        <a href="../sprints/create.php?idProjet=<?= $p['id'] ?>">Ajouter Sprint</a> |
        <a href="edit.php?id=<?= $p['id'] ?>">Modifier</a> |
        <a href="delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Supprimer projet ?')">Supprimer</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
    <?php require_once "../includes/footer.php"; ?>