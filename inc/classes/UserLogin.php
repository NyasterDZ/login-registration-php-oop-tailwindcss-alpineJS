<?php

class UserLogin {
    private $db;
    private $email;
    private $password;

    public function __construct($db, $email, $password){
        $this->db = $db;
        $this->email = $email;
        $this->password = $password;
    }

    private function auth(){
        $query = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $query->bind_param('s',$this->email);
        $query->execute();
        $result = $query->get_result();

        if($result->num_rows > 0 ){
            $user = $result->fetch_assoc();
            $password = $user["password"];
            $status =   password_verify($this->password, $password);
            return $status ? [$status, $user["id"]] : $status;
        }else{
            return false;
        }
    }

    public function login(){
        
        if($this->auth()[0]){
            $_SESSION["id"] = $this->auth()[1];
            return true;
        }else{
            return false;
        }

    }

}