<?php
    require_once "../core/guard.php";
    require_once "../classes/user.php";

    $user = Session::user();
    if($user['role'] !== 'admin') {
        die(" Accès interdit");
    }

    $u = new User();
    $users = $u->getAll()
?>

<h1>Liste des utilisateurs</h1>
<a href="create.php">Ajouter un utilisateur</a>
<table>
    <tr>
        <th>ID</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Role</th><th>Etat</th><th>Actions</th>
    </tr>
    <?php foreach($users as $usr): ?>
    <tr>
        <td><?= $usr['id'] ?></td>
        <td><?= $usr['nom'] ?></td>
        <td><?= $usr['prenom'] ?></td>
        <td><?= $usr['email'] ?></td>
        <td><?= $usr['roleUser'] ?></td>
        <td><?= $usr['etat'] ?></td>
        <td>
            <a href="edit.php?id=<?= $usr['id'] ?>">Modifier</a>
            <a href="delete.php?id=<?= $usr['id'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
