<?php

class Posts extends Controller {

    function __construct()
    {
        if(!isLoggedIn()) redirect('users/login'); 
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    function index() {
        
        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts
        ];

        $this->view('posts/index', $data);
    }

    // Add Post
    function add() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitiz Post Array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            // Validate Data
            if(empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            } else if(strlen($data['title']) < 3) {
                $data['title_err'] = 'The title must be at least 3 Characters';
            }

            if(empty($data['body'])) {
                $data['body_err'] = 'Please enter body text';
            } 

            if(empty($data['title_err']) && empty($data['body_err'])) {
                //  add post
                  $this->postModel->addPost($data);

                // flash message.
                flash('post_message', 'Post Added');

                // redirect to add index.
                redirect('posts/index');
            } else {
                $this->view('posts/add', $data);
            }
        } else {
            $this->view('posts/add');
        }
        
    }

    // Edit Post.
    function edit($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitiz Post Array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'title_err' => '',
                'body_err' => ''
            ];

            // Validate Data
            if(empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            } else if(strlen($data['title']) < 3) {
                $data['title_err'] = 'The title must be at least 3 Characters';
            }

            if(empty($data['body'])) {
                $data['body_err'] = 'Please enter body text';
            } 

            if(empty($data['title_err']) && empty($data['body_err'])) {
                //  add post
                  $this->postModel->updatePost($data);

                // flash message.
                flash('post_message', 'Post Updated');

                // redirect to add index.
                redirect('posts/show/'.$id);
            } else {
                $this->view('posts/edit', $data);
            }
        } 

        // Get a post from model.
        $post = $this->postModel->getPostById($id);

        // Check for owner.
        if($post->user_id !== $_SESSION['user_id']) {
            redirect('posts/show/' . $post->id);
        }
            $data = [
                'id' => $post->id,
                'title' => $post->title,
                'body' => $post->body
            ];
    
            $this->view('posts/edit', $data);

    }

    // Show Post
    function show($id) {
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);

        $data =  [
            'post' => $post,
            'user' => $user
        ];

        $this->view('posts/show', $data);
    }

    //  Delete Post
    function delete($id) {
        $post = $this->postModel->getPostById($id);
        if($post->user_id !== $_SESSION['user_id']) {
            // flash message.
            flash('post_message', 'it\'s not your post to delete', 'alert alert-danger');

            // Redirect to posts index.
            redirect('posts/index');
        } 
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
           
                 // Delete By id.
                 $this->postModel->deletePost($id);
        
                 // flash message.
                 flash('post_message', 'Post Deleted');
 
                 // Redirect to posts index.
                 redirect('posts/index');
        }
    }
}