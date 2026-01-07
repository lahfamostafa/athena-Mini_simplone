<?php
require_once "../core/guard.php";

$user = Session::user();

if ($user['role'] !== 'chef_projet') {
    die("Accès interdit");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chef de Projet</title>
</head>
<body>
    <h1>📌 Dashboard Chef de Projet</h1>

    <p>Bienvenue <?= htmlspecialchars($user['prenom']) ?></p>

    <ul>
        <li><a href="../projects/my_projects.php">📁 Mes projets</a></li>
        <li><a href="../sprints/index.php">🏃‍♂️ Gérer sprints</a></li>
        <li><a href="../tasks/index.php">✅ Gérer tâches</a></li>
        <li><a href="../public/logout.php">🚪 Déconnexion</a></li>
    </ul>
</body>
</html>
