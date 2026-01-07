<?php
    require_once '../classes/user.php';
    require_once '../config/Database.php';
    require_once '../core/Session.php';

    Session::start();
    $connected = Session::user();

    if(!$connected || $connected['role'] !== 'admin'){
        die('Accès interdit');
    }

    if(!isset($_GET['id'])){
        die("ID manquant");
    }

    $id= $_GET['id'];
    $u = new User();
    $user = $u->findById($_GET['id']);

    if(!$user){
        die('Utilsateur introuvable');
    }

    $error = null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        try {
            $u->update($user['id'],$_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['role']);
            header('Location: index.php');
            exit;
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
?>

<h2>Modifier utilisateur</h2>

<?php if ($error): ?>
    <p style="color:red"><?= $error ?></p>
<?php endif; ?>

<form method="POST">
    <input type="text" name="nom" value="<?= $user['nom'] ?>" required><br>
    <input type="text" name="prenom" value="<?= $user['prenom'] ?>" required><br>
    <input type="email" name="email" value="<?= $user['email'] ?>" required><br>

    <select name="role" required>
        <option value="admin" <?= $user['roleUser'] === 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="chef_projet" <?= $user['roleUser'] === 'chef_projet' ? 'selected' : '' ?>>Chef de projet</option>
        <option value="membre" <?= $user['roleUser'] === 'membre' ? 'selected' : '' ?>>Membre</option>
    </select><br>

    <button type="submit">Enregistrer</button>
</form>
