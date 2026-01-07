<?php
require_once "../core/guard.php";

$user = Session::user();
if ($user['role'] !== 'admin') {
    die("Accès interdit");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1> Dashboard Admin</h1>
    <p>Bienvenue <?= htmlspecialchars($user['nom']) ?></p>

    <h2>Gestion des utilisateurs</h2>
    <ul>
        <li><a href="../users/index.php">Liste des utilisateurs</a></li>
        <li><a href="../users/create.php">Ajouter un utilisateur</a></li>
    </ul>

    <h2>Gestion des projets</h2>
    <ul>
        <li><a href="../projects/index.php">Liste des projets</a></li>
        <li><a href="../projects/create.php">Ajouter un projet</a></li>
    </ul>

    <a href="../public/logout.php">Déconnexion</a>
</body>
</html>
