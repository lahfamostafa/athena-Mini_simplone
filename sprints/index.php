<?php
require_once "../core/guard.php";
require_once "../classes/Sprint.php";

$idProjet = (int) $_GET['idProjet'];

$sprintModel = new Sprint();
$sprints = $sprintModel->getByProjet($idProjet);
?>

<h1>Sprints du projet</h1>
<a href="create.php?idProjet=<?= $idProjet ?>">Nouveau sprint</a>

<table>
<tr>
    <th>Nom</th><th>Début</th><th>Fin</th><th>Etat</th><th>Actions</th>
</tr>

<?php foreach($sprints as $s): ?>
<tr>
    <td><?= $s['nom'] ?></td>
    <td><?= $s['date_debut'] ?></td>
    <td><?= $s['date_fin'] ?></td>
    <td><?= $s['etat'] ?></td>
    <td>
        <?php if($s['etat']=='active'): ?>
            <a href="etat.php?id=<?= $s['id'] ?>&etat=terminé&idProjet=<?= $idProjet ?>">Terminer</a>
        <?php endif; ?>
        <a href="delete.php?id=<?= $s['id'] ?>&idProjet=<?= $idProjet ?>"
           onclick="return confirm('Supprimer sprint ?')">Supprimer</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
