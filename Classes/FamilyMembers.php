<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/TEMP/config.php');
class FamilyMembers{
    public $Firstname;
    public $Middlename;
    public $Lastname;
    public $Mobilenumber;
    public $Email;
    public $Password;
    public $DOB;
    public $Gender;
    public $Address;
    public $Education;
    public $Business;
    public $BloudGroup;
    public $MaritalStatus;
    public $Age;
    public $Photo;
    public $RelationWithHead;
    
    public function __construct($data)
    {
        if($data['Action'] == "CreateMember"){
            $this->Firstname = $data['Firstname'];
            $this->Middlename = $data['Middlename'];
            $this->Lastname = $data['Lastname'];
            $this->Mobilenumber = $data['Mobilenumber'];
            $this->Email = $data['Email'];
            if(empty($data['ID']) && empty($data['Password'])){
                $this->Password = "NewPassword";
            }else{
                $this->Password = "UpdatePassword";
                //$this->Password = $data['Password'];
            }
            $this->DOB = $data['DOB'];
            $this->Gender = $data['Gender'];
            $this->Address = $data['Address'];
            $this->Education = $data['Education'];
            $this->Business = $data['Business'];
            $this->BloudGroup = $data['BloudGroup'];
            $this->MaritalStatus = $data['MaritalStatus'];
            $this->Age = $data['Age'];
            $this->Photo = $data['Photo'];
            $this->RelationWithHead = $data['RelationWithHead'];
        }

    }
    public function CreateUser(){
        $db = new db();
        try {
            $CheckUserquery = $db->prepare("SELECT `Email` FROM FamilyMembers WHERE `Email`=:Email");
            $CheckUserquery->bindValue(':Email', $this->Email, PDO::PARAM_STR);
            $CheckUserquery->execute();
            if($CheckUserquery->rowCount() == 0){
                $CreateUserquery = $db->prepare("INSERT INTO FamilyMembers (`FamilyNumber`, `Firstname`, `Middlename`, `Lastname`, `Mobilenumber`, `Email`, `Password`, `DOB`, `Gender`, `Address`, `Education`, `Business`, `BloudGroup`, `MaritalStatus`, `Age`, `Photo`, `RelationWithHead`, `CreatedTFK`) VALUES (:FamilyNumber, :Firstname, :Middlename, :Lastname, :Mobilenumber, :Email, :Password, :DOB, :Gender, :Address, :Education, :Business, :BloudGroup, :MaritalStatus, :Age, :Photo, :RelationWithHead, :CreatedTFK)");
                //for integer $query->bindValue(':description', $this->description, PDO::PARAM_INT);
                $CreateUserquery->bindValue(':FamilyNumber', 1, PDO::PARAM_INT);
                $CreateUserquery->bindValue(':Firstname', $this->Firstname, PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Middlename', $this->Middlename, PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Lastname', $this->Lastname, PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Mobilenumber', $this->Mobilenumber, PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Email', $this->Email, PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Password', $this->Password, PDO::PARAM_STR);
                $CreateUserquery->bindValue(':DOB', $this->DOB, PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Gender', $this->Gender, PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Address', $this->Address, PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Education', $this->Education, PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Business', $this->Business, PDO::PARAM_STR);
                $CreateUserquery->bindValue(':BloudGroup', $this->BloudGroup, PDO::PARAM_STR);
                $CreateUserquery->bindValue(':MaritalStatus', $this->MaritalStatus, PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Age', $this->Age, PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Photo', $this->Photo, PDO::PARAM_STR);
                $CreateUserquery->bindValue(':RelationWithHead', $this->RelationWithHead, PDO::PARAM_STR);
                $CreateUserquery->bindValue(':CreatedTFK', $_SESSION['AdminID'], PDO::PARAM_INT);
                $CreateUserquery->execute();
                return json_encode(array(
                    "Status" => "Passed",
                    "Message"=>"User created successfully."
                ));
            }else{
                return json_encode(array(
                    "Status" => "Failed",
                    "Message"=>"Email already exist. Please try with another email"
                ));
            }
        } catch (PDOException $e) {
            return json_encode(array(
                "Status" => "Failed",
                "Message"=>$e->getMessage()
            ));
            //"Message"=>$query->queryString
           //logError($e->getMessage(), $query->queryString, __FILE__, __LINE__);
            exit;
        }
    }
    public function fetchUserlist() {
        $db = new db();
        $CheckUserquery = $db->prepare("SELECT * FROM users");
        $CheckUserquery->execute();
        $result= $CheckUserquery->fetchAll();
        return json_encode($result);
    }
    public function DeleteUser($id){
        $db = new db();
        try {
            $CheckUserquery = $db->prepare("SELECT `id` FROM users WHERE `id`=:id");
            $CheckUserquery->bindValue(':id', $id, PDO::PARAM_INT);
            $CheckUserquery->execute();
            if($CheckUserquery->rowCount() == 1){
                $DeleteUserquery = $db->prepare("DELETE FROM users WHERE `id`=:id");
                $DeleteUserquery->bindValue(':id', $id, PDO::PARAM_INT);
                $DeleteUserquery->execute();
                return json_encode(array(
                    "Status" => "Passed",
                    "Message"=>"User Deleted successfully."
                ));
            }else{
                return json_encode(array(
                    "Status" => "Failed",
                    "Message"=>"Id doesn't exist."
                ));
            }
        } catch (PDOException $e) {
            return json_encode(array(
                "Status" => "Failed",
            ));
            exit;
        }
    }
}
?>