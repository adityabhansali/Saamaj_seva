<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/TEMP/config.php');
$response = array();
$error = array();
if (empty($_POST["Firstname"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please insert First name");
}
if (empty($_POST["Middlename"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please insert Middle name");
}
if (empty($_POST["Lastname"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please insert Last name");
}
if (empty($_POST["Mobilenumber"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please insert Mobile number");
}
if (empty($_POST["Email"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please insert Email");
}
if (!empty($_POST["Email"]) && !filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)) {
    $response["Status"] ="Failed";
    array_push($error,"Please insert valid email");
}
if (empty($_POST["DOB"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please insert Date of birth");
}
if (empty($_POST["Gender"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please select gender");
}
if (empty($_POST["Address"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please insert Address");
}
if (empty($_POST["Education"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please insert Education");
}
if (empty($_POST["Business"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please insert Business/Job");
}
if (empty($_POST["BloudGroup"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please select BloudGroup");
}
if (empty($_POST["MaritalStatus"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please select Marital Status");
}
if (empty($_POST["Age"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please Add Age");
}
if (empty($_FILES["Photo"])) {
    $response["Status"] ="Failed";
    array_push($error,"Please Upload Photo");
}
if(empty($error)){
    $userData = array();
    $userData["Action"] = "CreateMember";
    $userData['Firstname'] = $_POST["Firstname"];
    $userData['Middlename'] = $_POST["Middlename"];
    $userData['Lastname'] = $_POST["Lastname"];
    $userData['Mobilenumber'] = $_POST["Mobilenumber"];
    $userData['Email'] = $_POST["Email"];
    $original_date_str = $_POST["DOB"];
    $original_date = DateTime::createFromFormat('m/d/Y', $original_date_str);

// Convert to desired format
$formatted_date_str = $original_date->format('Y-m-d');
    $userData['DOB'] = $formatted_date_str;
    $userData['Gender'] = $_POST["Gender"];
    $userData['Address'] = $_POST["Address"];
    $userData['Education'] = $_POST["Education"];
    $userData['Business'] = $_POST["Business"];
    $userData['BloudGroup'] = $_POST["BloudGroup"];
    $userData['MaritalStatus'] = $_POST["MaritalStatus"];
    $userData['Age'] = $_POST["Age"];
    $userData['Photo'] = "PHOTO";
    $userData['RelationWithHead'] = 1;
    $FamilyMembers = new FamilyMembers($userData);
    $Userresponse = json_decode($FamilyMembers->CreateUser(), TRUE);
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