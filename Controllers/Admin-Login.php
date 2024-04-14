<?php
//Error Reporting
ini_set('error_reporting',1);
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once($_SERVER['DOCUMENT_ROOT'].'/SocietyManagement/config.php');
$response = array();
$error = array();
if (empty($_POST["email"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please insert your email");
}
if (!empty($_POST["email"]) && !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $response["Status"] ="Failed";
    array_push($error,"Please insert your valid email");
}
if (empty($_POST["password"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please select your password");
}
if(empty($error)){
    $LoginData = array();
    $LoginData['email'] = $_POST["email"];
    $LoginData['password'] = $_POST["password"];
    
    $LoginAuth = new auth();
    $Authresponse = json_decode($LoginAuth->AdminLogin($LoginData), TRUE);
    if($Authresponse['Status'] === "Passed"){
        $response["Status"] ="Passed";
        $response["Message"] = $Authresponse['Message'];
        $_SESSION['Email']  = $Authresponse['Data']['Email'];
        $_SESSION['IsAdmin']  = TRUE;
        $_SESSION['loggedin']  = TRUE;
    }else{
        $response["Status"] ="Failed";
        if(empty($Authresponse['Message'])){
            $response["Message"][0] = "Something Went wrong! Try again";
        }else{
            $response["Message"][0] = $Authresponse['Message'];
        }
    }
    echo json_encode($response);die;
}else{
    $response["Message"] = $error;
    echo json_encode($response);die;
}

?>