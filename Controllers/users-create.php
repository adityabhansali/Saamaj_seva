<?php 
require_once('../config.php');
$response = array();
$error = array();
if (empty($_POST["fname"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please insert your First name");
}
if (empty($_POST["lname"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please insert your Last name");
}
if (empty($_POST["email"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please insert your email");
}
if (!empty($_POST["email"]) && !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $response["Status"] ="Failed";
    array_push($error,"Please insert your valid email");
}
if (empty($_POST["phone"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please insert your phone number");
}
if (empty($_POST["dob"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please insert your Date of birth");
}
if (empty($_POST["gender"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please select your gender");
}
if (empty($_POST["country"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please select your country");
}
if(empty($error)){
    $userData = array();
    $userData['fname'] = $_POST["fname"];
    $userData['lname'] = $_POST["lname"];
    $userData['email'] = $_POST["email"];
    $userData['phone'] = $_POST["phone"];
    $userData['dob'] = $_POST["dob"];
    $userData['gender'] = $_POST["gender"];
    $userData['country'] = $_POST["country"];
    $users = new users($userData);
    $Userresponse = json_decode($users->CreateUser(), TRUE);
    if($Userresponse['Status'] === "Passed"){
        $response["Status"] ="Passed";
        $response["Message"] = $Userresponse['Message'];
    }else{
        $response["Status"] ="Failed";
        if(empty($Userresponse['Message'])){
            $response["Message"][0] = "Something Went wrong! Try again";
        }else{
            $response["Message"][0] = $Userresponse['Message'];
        }
    }
    echo json_encode($response);die;
}else{
    $response["Message"] = $error;
    echo json_encode($response);die;
}

?>