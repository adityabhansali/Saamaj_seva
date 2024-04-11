<?php
require_once('../config.php');
if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $familymember = new FamilyMembers(array("Action"=>"DeleteData"));
    echo $familymember->DeleteUser($_POST['id']);
}
