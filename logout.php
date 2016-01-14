<?php
session_start();
session_destroy();
setcookie("user_logged","");
setcookie("fbuser_logged","");
header('Location: /');