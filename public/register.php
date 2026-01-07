<?php
    require_once "../classes/user.php";
    require_once "../core/auth.php";
    require_once "../core/Session.php";
    require_once "../config/Database.php";

    Session::start();

    $error = null;
    $success = null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        try {
            $auth = new auth();

            $auth->register(
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                $_POST['password'],
                $_POST['role']
            );

            $success = "Compte créé avec succès. Vous pouvez vous connecter.";
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
?>

<form method="POST">
    <input type="text" name="nom" placeholder="Nom" required><br>
    <input type="text" name="prenom" placeholder="Prénom" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br>

    <select name="role" required>
        <option value="">-- Choisir rôle --</option>
        <option value="admin">Admin</option>
        <option value="chef_projet">Chef de projet</option>
        <option value="membre">Membre</option>
    </select><br>

    <button type="submit">S'inscrire</button>
</form>

<?php if ($error): ?>
    <p style="color:red"><?= $error ?></p>
<?php endif; ?>

<?php if ($success): ?>
    <p style="color:green"><?= $success ?></p>
<?php endif; ?>
