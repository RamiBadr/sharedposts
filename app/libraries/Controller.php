<?php

/*

* Base Controller.
* Loads the models & views

*/

class Controller {
    // Load Model
    public function model($model) {
        require_once "../app/models/$model.php";

        // return Instantiated model
        return new $model();
    }

    public function view($view, $data = []) {
        // Check for view file.
        if(file_exists("../app/views/$view.php")) {
            require_once "../app/views/$view.php";
        } else {
            // View deosn't exist.
            die("View deosn't exist!");
        }
    }
}