
<?php
session_start();
require_once('../more/db.php');
require_once('../more/functions.php');

if (!empty($_POST)) {

    $errors = [];

    // Pseudo
    if (empty($_POST['username']) || !preg_match("#^[a-zA-Z0-9_]+$#", $_POST['username'])) {
        $errors['username'] = "Erreur : Pseudonyme incorrect";
    } else {
        // SELECT * FROM users WHERE username = post
        $query = "SELECT * FROM users WHERE username = ?";
        $req = $pdo->prepare($query);
        $req->execute([$_POST['username']]);
        if ($req->fetch()) {
            $errors['username'] = "Erreur : Ce pseudonyme n'est pas disponible";
        }
    }

    // Email
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Erreur : Votre e-mail n'est pas valide";
    } else {
        // SELECT * FROM users WHERE email = post
        $query = "SELECT * FROM users WHERE email = ?";
        $req = $pdo->prepare($query);
        $req->execute([$_POST['email']]);
        if ($req->fetch()) {
            $errors['email'] = "Erreur : Cette adresse mail est déjà enregistré";
        }
    }

    // Password
    if (empty($_POST['password']) || $_POST['password'] !== $_POST['password_confirm']) {
        $errors['password'] = "Vous devez rentrez un mot de passe valide et confirmé";
    }

    if (empty($errors)) {
        $query = "INSERT INTO users(username,email,password,confirmation_token) VALUES(?,?,?,?)";
        $req = $pdo->prepare($query);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $token = generateToken(10);

        $req->execute([$_POST['username'], $_POST['email'], $password, $token]);
        $userId = $pdo->lastInsertId();

        $mail = 'yy.iris85@gmail.com';
        $subject = "Confirmation du compte";
        $message = "Afin de confirmer votre compte,merci de cliquer sur ce lien\n\n
        http://localhost/compte/confirm.php?id=$userId&token=$token";
        mail($mail, $subject, $message);


        $_SESSION['flash']['success'] = "Compte créé, veillez vérifier votre boite mail afin de confirmer votre compte";

        header("Location: login.php");
        exit();
    }
}

// Page HTML
?>
<?php include('../comp/header.php') ?>
<div class="col-md-8 col-md-offset-2">
    <h1 style="color: #fff;">Inscription</h1>
    <form action="" method="post">
        <fieldset>
            <div class="form-group">
                <label for="pseudo">Nom d'utilisateur</label>
                <input type="text" id="pseudo" class="form-control" name="username">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <label for="password">Confirmation</label>
                <input type="password" id="password" class="form-control" name="password_confirm" >
            </div>
            <input type="submit" class="btn btn-primary" value="S'inscrire">
            <a>Vous avez déjà un compte ?</a>
        </fieldset>
    </form>
</div>

<?php
require_once './footer.php';
?>