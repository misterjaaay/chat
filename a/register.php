<?php
require_once 'lib/function.php';
require_once 'class/User.php'; 
require_once 'header.php';
require_once 'footer.php';


$newRegister = new User;
$register1 = $newRegister->UserRegister();
echo 11;


getFooter();