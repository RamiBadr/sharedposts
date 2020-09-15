<?php require_once APPROOT . "/views/inc/header.php" ?>


    <div class="mt-5">  
    <?= flash('post_message');?>  
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Posts</h1>
        </div>
        <div class="col-md-6">
            <a href="<?= URLROOT ?>/posts/add" class="btn btn-primary float-right">
                <i class="fas fa-pencil-alt"></i> Add Post
            </a>
        </div>
    </div>
    <?php 
    foreach($data['posts'] as $post) : ?>
                <div class="card card-body mb-3">
                    <h4 class='card-title'><?=$post->title?></h4>
                    <p class='bg-light p-2 mb-3'>
                        Written By <?= $post->name; ?> on <?= $post->postCreatedAt ?>
                    </p>
                    <p class='card-text'><?= $post->body ?></p>
                    <a href="<?= URLROOT; ?>/posts/show/<?= $post->postId ?>" class="btn btn-dark">more</a>
                </div>
    <?php endforeach; ?>
    </div>
<?php require_once APPROOT . "/views/inc/footer.php" ?>