<?php
require_once __DIR__ . "/../core/Session.php";
Session::start();
$user = Session::user();

if(!$user){
    header("Location: ../auth/login.php");
    exit;
}

$role = $user['role'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard <?= ucfirst($role) ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        header { background: #2c3e50; color: #fff; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        nav a { color: #fff; text-decoration: none; margin-right: 15px; }
        nav a:hover { text-decoration: underline; }

        table { border-collapse: collapse; width: 100%; margin-top: 10px; background: #fff; }
        table th, table td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        table th { background-color: #2980b9; color: #fff; }
        table tr:nth-child(even) { background-color: #f2f2f2; }

        form { background: #fff; padding: 20px; border-radius: 5px; max-width: 500px; }
        form input, form select, form button { width: 100%; padding: 8px; margin-bottom: 10px; border-radius: 4px; border: 1px solid #ccc; }
        form button { background: #2980b9; color: #fff; border: none; cursor: pointer; }
        form button:hover { background: #3498db; }
    </style>
</head>
<body>
<header>
    <h1>Dashboard <?= ucfirst($role) ?></h1>
    <nav>
        <?php if($role === 'admin'): ?>
            <a href="../dashboard/admin.php">Dashboard</a>
            <a href="../users/index.php">Utilisateurs</a>
            <a href="../projets/index.php">Projets</a>
        <?php elseif($role === 'chef_projet'): ?>
            <a href="../dashboard/chef.php">Mes projets</a>
            <a href="../projets/my_projets.php">Projets</a>
            <a href="../sprints/my_sprints.php">Mes sprints</a>
        <?php elseif($role === 'membre'): ?>
            <a href="../dashboard/membre.php">Mes tâches</a>
            <a href="../projets/my_projets.php">Projets</a>
            <a href="../sprints/my_sprints.php">Sprints</a>
        <?php endif; ?>
        <a href="../auth/logout.php">Déconnexion</a>
    </nav>
</header>

<?php if(isset($_SESSION['alert'])): ?>
    <script>alert("<?= $_SESSION['alert'] ?>");</script>
    <?php unset($_SESSION['alert']); ?>
<?php endif; ?>
