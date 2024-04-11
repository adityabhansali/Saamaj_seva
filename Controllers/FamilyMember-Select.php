<?php
require_once('../config.php');
$familymember = new FamilyMembers(array("Action"=>"FetchData"));
echo $familymember->fetchUserlist();
