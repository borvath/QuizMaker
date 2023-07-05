<?php
class User {

    private Database $db;

    public function __construct() {
        $this->db = new Database;
    }
    public function Signup($username, $password) : mixed {
        $this->db->Query('INSERT INTO user(user_username, user_password) VALUES(:username, :password)');
        $this->db->Bind('username', $username);
        $this->db->Bind('password', $password);

        return ($this->db->execute() ? $this->GetUserByUserName($username) : false);
    }
    public function Login($username, $password) : mixed {
        $user = $this->GetUserByUserName($username);
        return password_verify($password, $user->user_password) ? $user : false;
    }
    public function FindUsername($value) : bool {
        $this->db->Query('SELECT user_username FROM user WHERE user_username = :value');
        $this->db->Bind('value', $value);

        $user = $this->db->GetSingleResult();
        return (!empty($this->db->NumResults()));
    }
    public function GetUserByUserName($username) : mixed {
        $this->db->Query('SELECT * FROM user WHERE user_username = :username');
        $this->db->Bind('username', $username);

        return $this->db->GetSingleResult();
    }
}