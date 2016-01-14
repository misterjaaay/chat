<?php
session_start();
session_destroy();
setcookie("user_logged","");
setcookie("user_link","");
header('Location: /');