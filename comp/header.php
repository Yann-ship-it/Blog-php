<header>
    <div class="container">
        <h1>Blog</h1>

        <ul class="nav">
            <li><a href="/Blog/index.php">Accueil</a></li>
            <li><a href="/Blog/posts/index.php">Admin posts</a></li>
            <?php if (isset($_SESSION['auth'])) : ?>
                <li><a href="./compte/logout.php">Se deconnecter</a></li>
            <?php else : ?>
                <li class="active"><a href="./compte/register.php">S'enregistrer <span class="sr-only"></span></a></li>
                <li><a href="./compte/login.php">Se connecter</a></li>
            <?php endif; ?>
            <li><a href="./compte/admin_compte.php">Admin compte</a></li>
        </ul>
    </div>
</header>