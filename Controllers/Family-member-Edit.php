<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/SocietyManagement/config.php');
//print_r($_REQUEST);
//print_r($_FILES);
//    die;
$response = array();
$error = array();
$array = $_POST;
$filesarray = $_FILES;
if (isset($array['membercount'])) {
    $membercount = $array['membercount'];
    $arrays = array();

    for ($m = 0; $m < $membercount; $m++) {
        $temp_array = array();
        foreach ($array as $key => $value) {
            if (substr($key, -2) === "-$m") {
                $temp_array[substr($key, 0, -2)] = $value;
            }
        }
        $photo_key = "Photo-$m";
        if (isset($filesarray[$photo_key])) {
            if( $filesarray[$photo_key]['error'] == 0)
            {
                $temp_array['Photo'] = $filesarray[$photo_key];
            }
        }
        $arrays[] = $temp_array;
    }
    foreach ($arrays as $key => $value)
    {
        $familymember = new FamilyMembers(array("Action"=>"EditData"));
        if(empty($value["ID"]))
        {
            $response[] = $familymember->CreateFamilyUserID($value,$_POST['FamilyNumber']);
        }
        else{
            $response[] = $familymember->UpdateFamilyUserID($value,$_POST['FamilyNumber']);
        }
    }
    echo json_encode($response);die;
} else {
    $error[] = "Data was not sent properly";
}