<?php

session_start();

require_once "../classes/user.php";

$users = new Users;

$users->pageVisible();
$users->checkLogin();