<?php 
require_once('../config.php');
$userData = array("FetchData");
$users = new users($userData);
echo $userData = $users->fetchUserlist();die;
