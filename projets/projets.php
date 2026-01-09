<?php
require_once "../includes/header.php";
require_once "../classes/Projet.php";
require_once "../classes/User.php";

$user = Session::user();

if (!in_array($user['role'], ['admin','chef_projet'])) {
    die("Accès interdit");
}

$projetModel = new Projet();
$projets = $projetModel->getAll(); 
?>

<h2>Liste des projets</h2>
<a href="create.php">Nouveau projet</a>

<table>
<tr>
    <th>Titre</th>
    <th>Chef</th>
    <th>Date début</th>
    <th>Date fin</th>
    <th>Etat</th>
    <th>Actions</th>
</tr>

<?php foreach($projets as $p): ?>
<tr>
    <td><?= htmlspecialchars($p['titre']) ?></td>
    <td><?= htmlspecialchars($p['nom'] . " " . $p['prenom']) ?></td>
    <td><?= $p['date_debut'] ?></td>
    <td><?= $p['date_fin'] ?></td>
    <td>
        <?php if($p['etat'] === 'active'): ?>
            <a href="etat.php?id=<?= $p['id'] ?>&etat=desactive" onclick="return confirm('Changer l\'état du projet ?')">Désactiver</a>
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

<?php require_once "../includes/footer.php"; ?>
