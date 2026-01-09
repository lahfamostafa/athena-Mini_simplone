<?php
require_once "../includes/header.php";
require_once "../core/guard.php";

$user = Session::user();

if ($user['role'] !== 'membre') {
    die(" Accès interdit");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Membre</title>
</head>
<body>
    <h1>👤 Dashboard Membre</h1>

    <p>Salut <?= htmlspecialchars($user['prenom']) ?></p>

    <ul>
        <li><a href="../tasks/my_tasks.php">🧾 Mes tâches</a></li>
        <li><a href="../projects/joined.php">📁 Mes projets</a></li>
        <li><a href="../public/logout.php">🚪 Déconnexion</a></li>
    </ul>
</body>
</html>
