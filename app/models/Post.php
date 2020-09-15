<?php

class Post {
    private $db;

    function __construct()
    {
        $this->db = new Database;
    }

    function getPosts() {
        $this->db->query('SELECT *,
                          posts.id as postId,
                          users.id as userId,
                          posts.created_at as postCreatedAt,
                          users.created_at as userCreatedAt
                         FROM posts
                         INNER JOIN users
                         ON posts.user_id = users.id
                         ORDER BY posts.created_at DESC
                         ');
        $this->db->execute();
        
        return $this->db->fetchAll();
    }

    public function getPostById($id)
    {
        $this->db->query("SELECT * FROM posts WHERE id=:id");
        $this->db->bind(':id', $id);
        return $this->db->fetch();
    }

    // Add Post.
    function addPost($data) {
        $this->db->query('INSERT INTO posts (`user_id`, `title`, `body`) VALUES(:userId, :title, :body)');

        // Bind Values.
        $this->db->bind(':userId', $data['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        // execute query.
       $this->db->execute();
    }

    // Edit Post.
    public function updatePost($data)
    {
        $this->db->query("UPDATE `posts` SET `title`= :title,`body`= :body WHERE id = :id");
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);
        return $this->db->execute();
    }

    // Delete Post.
    public function deletePost($id) {
        $this->db->query("DELETE FROM posts WHERE id=:id");
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

}