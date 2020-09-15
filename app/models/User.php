<?php

class User {
    private $db;

    function __construct()
    {
        $this->db = new Database;
    }

    // find User By Email.
    function findUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email=:email');
        $this->db->bind(':email', $email);
        $this->db->fetch();

        if($this->db->rowCount()) {
            return true;
        }

        return false;
    }

    function getUserById($id) {
        $this->db->query('SELECT * FROM users WHERE id=:id');
        $this->db->bind(':id', $id);
        return $this->db->fetch();
    }

    // Register User
    function register($data) {
        $this->db->query('INSERT INTO users (`name`, `email`, `password`) VALUES(:name, :email, :password)');

        // Bind Values.
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // execute query.
        if($this->db->execute()) {
            return true;
        }

        return false;
    }

    function login($email, $password) {
        $this->db->query('SELECT * FROM users WHERE email=:email');
        $this->db->bind(':email', $email);
        $row = $this->db->fetch();

        if(password_verify($password, $row->password)) {
            return $row;
        } 

        return false;
    }
}