<?php
require_once 'class/User.php';
include_once 'header.php';

$newLogout = new User;
$logout = $newLogout->logoutUser();



