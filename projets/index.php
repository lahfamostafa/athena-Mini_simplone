<?php
require_once "../core/guard.php";
require_once "../classes/Projet.php";

$user = Session::user();

if(!$user || $user['role'] !== 'chef_projet'){
    die("⛔ Accès interdit");
}

$projetModel = new Projet();

$projets = $projetModel->getByChefProjet($user['id']);
?>

<h1>Mes Projets</h1>

<a href="create.php">Créer un nouveau projet</a>

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
    <td>
        <?php if ($p['etat'] === 'active'): ?>
            <a href="etat.php?id=<?= $p['id'] ?>&etat=desactive" onclick="return confirm('Changer l\'état de ce projet ?')">Désactiver</a>
        <?php else: ?>
            <a href="etat.php?id=<?= $p['id'] ?>&etat=active">Activer</a>
        <?php endif; ?>
    </td>
    <td>
        <a href="../sprints/index.php?idProjet=<?= $p['id'] ?>">Voir Sprints</a> |
        <a href="../sprints/create.php?idProjet=<?= $p['id'] ?>">Ajouter Sprint</a> |
        <a href="edit.php?id=<?= $p['id'] ?>">Modifier</a> |
        <a href="delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Supprimer projet ?')">Supprimer</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
