<?php

session_start();

// Flash Message Helper

function flash($name = '', $message = '', $class = 'alert alert-success') {

    if(!empty($name) && empty($message) && !empty($_SESSION[$name])) {
        $sessionVar = $_SESSION[$name];
        unset($_SESSION[$name]);
        return "<div class='$class'>".$sessionVar."</div>";
    } else if(!empty($name) && !empty($message) && empty($_SESSION[$name])) {
        $_SESSION[$name] = $message; 
    }
}

// Check if logged in helper.

function isLoggedIn() {
    if(isset($_SESSION['user_id'])) {
        return true;
    }

    return false;
}