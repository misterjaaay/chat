<?php
include_once 'header.php';

/**
 * Created by PhpStorm.
 * User: jay
 * Date: 16.01.16
 * Time: 2:55
 */
require_once 'class/User.php';


$newLogin = new User;
$userLogin = $newLogin->UserLogin();


