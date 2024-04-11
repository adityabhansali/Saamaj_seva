<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/Saamj_seva/config.php');
class Auth{
    public $email;
    public $password;
    public function Login($Data){
        $db = new db();
        try {
            $CheckUserquery = $db->prepare("SELECT * FROM FamilyMembers WHERE `email`=:email");
            $CheckUserquery->bindValue(':email', $Data['email'], PDO::PARAM_STR);
            $CheckUserquery->execute();
            $result= $CheckUserquery->fetch();
            if($CheckUserquery->rowCount() == 1){
                $UserPassword = md5($Data['password']);
                if($UserPassword == $result['password']){
                    return json_encode(array(
                        "Status" => "Passed",
                        "Message"=>"User Login successfully.",
                        "Data" => $result
                    ));
                }else{
                    return json_encode(array(
                        "Status" => "Failed",
                        "Message"=>"Please enter correct Password."
                    ));
                }           
            }else{
                return json_encode(array(
                    "Status" => "Failed",
                    "Message"=>"User Doesn't exist."
                ));
            }
        } catch (PDOException $e) {
            return json_encode(array(
                "Status" => "Failed",
            ));
           //logError($e->getMessage(), $query->queryString, __FILE__, __LINE__);
            exit;
        }

    }

    public function AdminLogin($Data){
        $db = new db();
        try {
            /* if($Data['email'] == Admin_EMAIL){
                $CheckUserquery = $db->prepare("SELECT * FROM FamilyMembers WHERE `FMID`=:FMID");
                $CheckUserquery->bindValue(':FMID', 0, PDO::PARAM_INT);
                $CheckUserquery->execute();
            }else{
                $CheckUserquery = $db->prepare("SELECT * FROM FamilyMembers WHERE `Email`=:email");
                $CheckUserquery->bindValue(':email', $Data['email'], PDO::PARAM_STR);
                $CheckUserquery->execute();
            } */
            $CheckUserquery = $db->prepare("SELECT * FROM FamilyMembers WHERE `Email`=:email AND `IsAdmin` = 1");
            $CheckUserquery->bindValue(':email', $Data['email'], PDO::PARAM_STR);
            $CheckUserquery->execute();
            $result= $CheckUserquery->fetch();
           /*  if($Data['email'] == Admin_EMAIL){
                $result['Email'] = Admin_EMAIL;
            } */
            if($CheckUserquery->rowCount() == 1){
                $UserPassword = md5($Data['password']);
                if($UserPassword == $result['Password']){
                    return json_encode(array(
                        "Status" => "Passed",
                        "Message"=>"User Login successfully.",
                        "Data" => $result
                    ));
                }else{
                    return json_encode(array(
                        "Status" => "Failed",
                        "Message"=>"Please enter correct Password."
                    ));
                }           
            }else{
                return json_encode(array(
                    "Status" => "Failed",
                    "Message"=>"User Doesn't exist."
                ));
            }
        } catch (PDOException $e) {
            return json_encode(array(
                "Status" => "Failed",
            ));
           //logError($e->getMessage(), $query->queryString, __FILE__, __LINE__);
            exit;
        }

    }
}