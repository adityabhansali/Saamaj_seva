<?php 
require_once('../config.php');
$userData = array("DeleteUser");
$users = new users($userData);
$response = array();
$error = array();
if (empty($_POST["id"])) {
    $response["Status"] ="Failed";
    array_push($error,"Something went wrong!");
}
if(!empty($error)){
    $response["Message"] = $error;
    echo json_encode($response);die;
}else{
    $userId = $_POST['id'];
    $DeleteUser = json_decode($users->DeleteUser($userId), TRUE);
    if($DeleteUser['Status'] === "Passed"){
        $response["Status"] ="Passed";
        $response["Message"] = $DeleteUser['Message'];
    }else{
        $response["Status"] ="Failed";
        $response["Message"][0] = $DeleteUser['Message'];
    }
    echo json_encode($response);die;
}
