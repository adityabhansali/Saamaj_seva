<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/SocietyManagement/config.php');
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
        $CheckUserquery = $db->prepare("SELECT * FROM FamilyMembers");
        $CheckUserquery->execute();
        $result= $CheckUserquery->fetchAll();
        return json_encode($result);
    }
    public function fetchFamilyListByNumber($id) {
        $db = new db();
        $CheckUserquery = $db->prepare("SELECT * FROM FamilyMembers Where `FamilyNumber` =:id order by `ID`");
        $CheckUserquery->bindValue(':id', $id, PDO::PARAM_INT);
        $CheckUserquery->execute();
        $result= $CheckUserquery->fetchAll();
        return json_encode($result);
    }
    public function DeleteUser($id){
        $db = new db();
        try {
            $CheckUserquery = $db->prepare("SELECT `id` FROM FamilyMembers WHERE `id`=:id");
            $CheckUserquery->bindValue(':id', $id, PDO::PARAM_INT);
            $CheckUserquery->execute();
            if($CheckUserquery->rowCount() == 1){
                $DeleteUserquery = $db->prepare("DELETE FROM FamilyMembers WHERE `id`=:id");
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
    public function CreateFamilyUser($data){

        $db = new db();
        try {
            $getadminid = $db->queryFetchAllAssoc('SELECT `id` FROM FamilyMembers where `Email` = "'.$_SESSION['Email'].'"LIMIT 1')[0]['id'];
            $getlastfamilyid = $db->queryFetchAllAssoc("SELECT `FamilyNumber` FROM FamilyMembers ORDER BY `id` DESC LIMIT 1");
            $CheckUserquery = $db->prepare("SELECT `Email` FROM FamilyMembers WHERE `Email`=:Email");
            $CheckUserquery->bindValue(':Email', $data['Email'], PDO::PARAM_STR);
            $CheckUserquery->execute();
            if($CheckUserquery->rowCount() == 0){
                if(!isset($data['RelationToHead']))
                {
                    $getlastfamilyid[0]['FamilyNumber']++;
                    $data['RelationToHead'] = 'own';
                }
                $CreateUserquery = $db->prepare("INSERT INTO FamilyMembers (`FamilyNumber`, `Firstname`, `Middlename`, `Lastname`, `Mobilenumber`, `Email`, `Password`, `DOB`, `Gender`, `Address`, `Education`, `Business`, `BloudGroup`, `MaritalStatus`, `Age`, `Photo`, `RelationWithHead`, `CreatedTFK`) VALUES (:FamilyNumber, :Firstname, :Middlename, :Lastname, :Mobilenumber, :Email, :Password, :DOB, :Gender, :Address, :Education, :Business, :BloudGroup, :MaritalStatus, :Age, :Photo, :RelationWithHead, :CreatedTFK)");
                //for integer $query->bindValue(':description', $this->description, PDO::PARAM_INT);
                $imageName = basename($data["Photo"]["name"]);
                $cleanImageName = str_replace(' ', '', $imageName);
                $imageName =time(). '_' . $cleanImageName;
                $uploadFile = UPLOAD_DIR . $imageName;
                if (!move_uploaded_file($data["Photo"]["tmp_name"], $uploadFile)) {
                    return json_encode(array(
                        "Status" => "Failed",
                        "Message"=>"Upload File Failed"
                    ));
                }
                $CreateUserquery->bindValue(':FamilyNumber', $getlastfamilyid[0]['FamilyNumber'], PDO::PARAM_INT);
                $CreateUserquery->bindValue(':Firstname', $data['Firstname'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Middlename', $data['Middlename'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Lastname', $data['Lastname'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Mobilenumber', $data['Mobilenumber'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Email', $data['Email'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Password', "PASSWORD", PDO::PARAM_STR);
                $CreateUserquery->bindValue(':DOB', DateTime::createFromFormat('d/m/Y', $data['DOB'])->format("Y-m-d"), PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Gender', $data['Gender'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Address', $data['Address'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Education', $data['Education'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Business', $data['Business'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':BloudGroup', $data['BloudGroup'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':MaritalStatus', $data['MaritalStatus'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Age', $data['Age'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Photo', $imageName, PDO::PARAM_STR);
                $CreateUserquery->bindValue(':RelationWithHead', $data['RelationToHead'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':CreatedTFK', $getadminid, PDO::PARAM_INT);
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
    public function CreateFamilyUserID($data,$familyid){

        $db = new db();
        try {
            $getadminid = $db->queryFetchAllAssoc('SELECT `id` FROM FamilyMembers where `Email` = "'.$_SESSION['Email'].'"LIMIT 1')[0]['id'];
            $CheckUserquery = $db->prepare("SELECT `Email` FROM FamilyMembers WHERE `Email`=:Email");
            $CheckUserquery->bindValue(':Email', $data['Email'], PDO::PARAM_STR);
            $CheckUserquery->execute();
            if($CheckUserquery->rowCount() == 0){
                if(!isset($data['RelationToHead']))
                {
                    $data['RelationToHead'] = 'own';
                }
                $CreateUserquery = $db->prepare("INSERT INTO FamilyMembers (`FamilyNumber`, `Firstname`, `Middlename`, `Lastname`, `Mobilenumber`, `Email`, `Password`, `DOB`, `Gender`, `Address`, `Education`, `Business`, `BloudGroup`, `MaritalStatus`, `Age`, `Photo`, `RelationWithHead`, `CreatedTFK`) VALUES (:FamilyNumber, :Firstname, :Middlename, :Lastname, :Mobilenumber, :Email, :Password, :DOB, :Gender, :Address, :Education, :Business, :BloudGroup, :MaritalStatus, :Age, :Photo, :RelationWithHead, :CreatedTFK)");
                //for integer $query->bindValue(':description', $this->description, PDO::PARAM_INT);
                $imageName = basename($data["Photo"]["name"]);
                $cleanImageName = str_replace(' ', '', $imageName);
                $imageName =time(). '_' . $cleanImageName;
                $uploadFile = UPLOAD_DIR . $imageName;
                if (!move_uploaded_file($data["Photo"]["tmp_name"], $uploadFile)) {
                    return json_encode(array(
                        "Status" => "Failed",
                        "Message"=>"Upload File Failed"
                    ));
                }
                $CreateUserquery->bindValue(':FamilyNumber', $familyid, PDO::PARAM_INT);
                $CreateUserquery->bindValue(':Firstname', $data['Firstname'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Middlename', $data['Middlename'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Lastname', $data['Lastname'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Mobilenumber', $data['Mobilenumber'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Email', $data['Email'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Password', "PASSWORD", PDO::PARAM_STR);
                $CreateUserquery->bindValue(':DOB', DateTime::createFromFormat('d/m/Y', $data['DOB'])->format("Y-m-d"), PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Gender', $data['Gender'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Address', $data['Address'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Education', $data['Education'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Business', $data['Business'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':BloudGroup', $data['BloudGroup'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':MaritalStatus', $data['MaritalStatus'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Age', $data['Age'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Photo', $imageName, PDO::PARAM_STR);
                $CreateUserquery->bindValue(':RelationWithHead', $data['RelationToHead'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':CreatedTFK', $getadminid, PDO::PARAM_INT);
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
    public function UpdateFamilyUserID($data,$familyid){
        $db = new db();
        try {
            $getadminid = $db->queryFetchAllAssoc('SELECT `id` FROM FamilyMembers where `Email` = "'.$_SESSION['Email'].'"LIMIT 1')[0]['id'];
            $CheckUserquery = $db->prepare("SELECT `Email` FROM FamilyMembers WHERE `Email`=:Email");
            $CheckUserquery->bindValue(':Email', $data['Email'], PDO::PARAM_STR);
            $CheckUserquery->execute();
            if($CheckUserquery->rowCount() != 0){
                if(!isset($data['RelationToHead']))
                {
                    $data['RelationToHead'] = 'own';
                }
                $CreateUserquery = $db->prepare("UPDATE FamilyMembers SET `Firstname` = :Firstname, `Middlename` = :Middlename , `Lastname`=:Lastname, `Mobilenumber`= :Mobilenumber, `Email` = :Email, `Password` = :Password, `DOB` = :DOB, `Gender` = :Gender, `Address` =:Address , `Education` = :Education, `Business` = :Business, `BloudGroup` = :BloudGroup, `MaritalStatus` = :MaritalStatus, `Age` = :Age, `Photo` = :Photo, `RelationWithHead` = :RelationWithHead, `CreatedTFK` = :CreatedTFK WHERE FamilyNumber = :FamilyNumber AND ID = :ID;");
                //for integer $query->bindValue(':description', $this->description, PDO::PARAM_INT);
                if(is_array($data['Photo']))
                {
                    $imageName = basename($data["Photo"]["name"]);
                    $cleanImageName = str_replace(' ', '', $imageName);
                    $imageName =time(). '_' . $cleanImageName;
                    $uploadFile = UPLOAD_DIR . $imageName;
                    if (!move_uploaded_file($data["Photo"]["tmp_name"], $uploadFile)) {
                        return json_encode(array(
                            "Status" => "Failed",
                            "Message"=>"Upload File Failed"
                        ));
                    }
                }
                else{
                    $imageName = $data['Photo'];
                }
                if(str_contains('/',$data['DOB']))
                {
                    $dob = DateTime::createFromFormat('d/m/Y', $data['DOB'])->format("Y-m-d");
                }
                else{
                    $dob = $data['DOB'];
                }
                $CreateUserquery->bindValue(':ID', $data['ID'], PDO::PARAM_INT);
                $CreateUserquery->bindValue(':FamilyNumber', $familyid, PDO::PARAM_INT);
                $CreateUserquery->bindValue(':Firstname', $data['Firstname'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Middlename', $data['Middlename'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Lastname', $data['Lastname'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Mobilenumber', $data['Mobilenumber'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Email', $data['Email'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Password', "PASSWORD", PDO::PARAM_STR);
                $CreateUserquery->bindValue(':DOB', $dob, PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Gender', $data['Gender'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Address', $data['Address'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Education', $data['Education'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Business', $data['Business'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':BloudGroup', $data['BloudGroup'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':MaritalStatus', $data['MaritalStatus'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Age', $data['Age'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':Photo', $imageName, PDO::PARAM_STR);
                $CreateUserquery->bindValue(':RelationWithHead', $data['RelationToHead'], PDO::PARAM_STR);
                $CreateUserquery->bindValue(':UpdatedTFK', $getadminid, PDO::PARAM_INT);
                $CreateUserquery->execute();
                return json_encode(array(
                    "Status" => "Passed",
                    "Message"=>"User Updated successfully."
                ));
            }else{
                return json_encode(array(
                    "Status" => "Failed",
                    "Message"=>"EMail doesn't exist"
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
}
?>