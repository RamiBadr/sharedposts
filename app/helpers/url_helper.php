<?php

// Simple page redirect

function redirect($view) {
    header('location: ' . URLROOT . '/' . $view);
}