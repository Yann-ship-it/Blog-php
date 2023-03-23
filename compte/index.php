<?php
session_start();
require_once '../more/functions.php';

reconnect_auto();
is_connect();

require_once './header.php';
?>

<h1>Hello <?= $_SESSION['auth']->username ?></h1>
<?php
require_once './footer.php';
?>