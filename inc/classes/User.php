<?php

class User{

private $db;
private $username;
private $email;
private $password;
private $error = array();
public function __construct($db,$username,$email,$password){
    $this->db = $db;
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
}

private function verifyUsername(){

    if(empty($this->username)){
        array_push($this->error,"Empty username");
    }else{
        if(!preg_match("/^[a-zA-Z0-9]+$/",$this->username)){
            array_push($this->error,"Username error form");
        }
    
        if(is_numeric($this->username[0])){
            array_push($this->error,"Username numeric error");
        }
    
        if(strlen($this->username) > 25 || strlen($this->username) < 5 ){
            array_push($this->error,"Username: 5 & 25");
        }
    
        $query = $this->db->prepare("SELECT username FROM users WHERE username = ? ");
        $query->bind_param("s", $this->username);
        $query->execute();
        $result = $query->get_result();
    
        if($result->num_rows > 0 ){
            array_push($this->error,"Username already exist");
        } 
    }
   
}

private function verifyEmail(){
    if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
        array_push($this->error,"Error in email form");
    }

    $query = $this->db->prepare("SELECT email FROM users WHERE email = ? ");
    $query->bind_param("s", $this->email);
    $query->execute();
    $result = $query->get_result();

    if($result->num_rows > 0 ){
        array_push($this->error,"Email already exist");
    }
}

private function verifyPassword(){
    if(strlen($this->password) > 30 || strlen($this->password) < 5 ){
        array_push($this->error,"Password: 5 & 30");
    }
}

public function getError(){
    return $this->error;
}

private function insertUser(){
    $password = password_hash($this->password,PASSWORD_BCRYPT);
    $query = $this->db->prepare("INSERT INTO users(username,email,password) VALUES(?,?,?) ");
    $query->bind_param("sss",$this->username,$this->email,$password);
    return $query->execute();
}

public function register(){

    $this->verifyUsername($this->username);
    $this->verifyEmail($this->email);
    $this->verifyPassword($this->password);
    return empty($this->error) ?  $this->insertUser($this->username,$this->email,$this->password) : false;  
}


}