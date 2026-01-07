<?php
    require_once "../config/Database.php";
    require_once "../classes/user.php";
    require_once "../core/Session.php";
    require_once "../core/auth.php";
    require_once "../core/permission.php";
    require_once "../core/reffus.php";

    Session::start();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $auth = new auth();
        try{
            $auth->login($_POST['email'],$_POST['password']);

            $user = auth::user();

            switch($user['role']){
                case 'admin':
                    header("Location: ../dashboard/admin.php");
                    break;
                case 'chef':
                    header("Location: ../dashboard/chef.php");
                    break;
                case 'membre':
                    header("Location: ../dashboard/membre.php");
                    break;
            }
            exit;
        }catch(Exception $e){
            $error = $e->getMessage();
        }
    }
?>

<form method="POST">
    <input type="email" name="email" placeholder="email" required><br>
    <input type="password" name="password" placeholder="password" required><br>
    <button type="submit">Se connecter</button>
</form>

<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>