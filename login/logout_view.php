<?php
session_start();

unset($_SESSION['userId']);
unset($_SESSION['roleId']);

header("Location: login/login_view.php");

exit();
?>