<?php
session_start();
session_destroy();
setcookie("user_logged","");
header('Location: index.php');