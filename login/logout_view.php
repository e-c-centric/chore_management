<?php
session_start();

unset($_SESSION['pid']);
unset($_SESSION['rid']);

header("Location: login_view.php");

exit();
?>