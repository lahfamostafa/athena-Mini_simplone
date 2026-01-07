<?php
require_once "../core/guard.php";
require_once "../classes/Projet.php";

$user = Session::user();

/* admin + chef */
if (!in_array($user['role'], ['admin','chef_projet'])) {
    die("⛔ Accès interdit");
}

$p = new Projet();
$projets = $p->getAll();
?>

<h1>Liste des projets</h1>
<a href="create.php"> Nouveau projet</a>

<table>
<tr>
    <th>Titre</th>
    <th>Chef</th>
    <th>Date début</th>
    <th>Date fin</th>
    <th>Etat</th>
    <th>Actions</th>
</tr>

<?php foreach($projets as $pr): ?>
<tr>
    <td><?= $pr['titre'] ?></td>
    <td><?= $pr['nom'] . " " . $pr['prenom'] ?></td>
    <td><?= $pr['date_debut'] ?></td>
    <td><?= $pr['date_fin'] ?></td>
    <td>
        <?php if ($pr['etat'] === 'active'): ?>
                <a href="etat.php?id=<?= $pr['id'] ?>&etat=desactive" onclick="return confirm('Changer l\'état de ce projet ?')">Désactiver</a>
            <?php else: ?>
                <a href="etat.php?id=<?= $pr['id'] ?>&etat=active">Avtiver</a>
            <?php endif; ?>
    <td>
        <a href="edit.php?id=<?= $pr['id'] ?>">Modifier</a>
        <a href="delete.php?id=<?= $pr['id'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce projet ?')">Supprimer</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
