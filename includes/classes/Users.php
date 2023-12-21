<?php 
class Users {
    private $username;
    private $email;
    private $password;
    private $description;
    private $phone_number;
    private $role;
    public static $email_error;
    public static $password_error;
    public function __construct($name , $email, $password, $description, $phone_number, $role){
        $this->username = $name;
        $this->email = $email;
        $this->password = $password;
        $this->description = $description;
        $this->phone_number = $phone_number;
        $this->role = $role;
    }
    public function getUserName(){
        return $this->username;
    }
    public function setUserName($new_name){
        $this->username = $new_name;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($new_email){
        $this->email = $new_email;
    }
    public function getDescription(){
        return $this->description;
    }
    public function setDescription($new_description){
        $this->description = $new_description;
    }
    public function getPhoneNumber(){
        return $this->phone_number;
    }
    public function setPhoneNumber($new_phone){
        $this->phone_number = $new_phone;
    }
    public function getRole(){
        return $this->role;
    }
    public function setRole($role){
        $this->role = $role;
    }
    public function comparePassword($new_password){
        return password_verify($new_password, $this->password);
    }
    public static function authentificateUser($connection, $email, $password){
        $query = "SELECT UserPassword FROM Users WHERE Email = '$email'";
        $result = mysqli_query($connection, $query);
        if(mysqli_num_rows($result) == 0){
            Users::$email_error = "email doesn't exist! please try to singing up.";
            return;
        }
        $row = mysqli_fetch_assoc($result);
        $crypted = $row['UserPassword'];
        if(password_verify($password, $crypted)){
            header("location:work.php");
        }else {
            Users::$password_error = "incorrect password!";
        }

    }
    public static function hashPassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    public static function verifyEmailExist($connection, $email){
        $query = "SELECT COUNT(*) as count FROM Users WHERE Email = '$email'";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("Query failed: " . mysqli_error($connection));
        }else {
            $row = mysqli_fetch_assoc($result);
            return $row["count"] > 0;
        }
    }
    public static function addUser($connection, $user, $location){

        $sql = "INSERT INTO Users (Username, Email, UserPassword, PhoneNumber, description, Role)
                VALUES (
                '$user->username',
                '$user->email',
                '$user->password',
                '$user->phone_number',
                '$user->description',
                '$user->role'
                );";   
            if (mysqli_query($connection, $sql)) {
                return true;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connection);
                return false;
            }
    }

};