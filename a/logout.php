<?php
require_once 'lib/function.php';
require_once 'class/User.php';


$newLogout = new User;
$logout = $newLogout->logoutUser();

require_once 'header.php';
require_once 'footer.php';


getFooter();