<?php

class Auth {

    public $user = null;
    public $type = "student";

    public function __construct() {
        if(Application::$session->has("auth")){ // Eğer oturumda giriş yapılmışsa...
            $authId = Application::$session->get("auth");
            $this->user = Application::$db->db->query("SELECT * FROM users WHERE id = ".$authId)->fetch(PDO::FETCH_OBJ);
            $this->type = $this->user->type;
        }
    }

    public function check() {
        return $this->user != null;
    }

    public function login($username, $password, $type = "student") {
        $check = Application::$db->db->prepare("SELECT * FROM users WHERE username = :username AND password = :password AND type = '".$type."'");
        $check->execute([
            'username' => $username,
            'password' => md5($password)
        ]);
        $check = $check->fetch(PDO::FETCH_OBJ);

        if($check) {
            Application::$session->set("auth", $check->id);
            return true;
        } else {
            return false;
        }
    }

}