<?php require_once APPROOT . "/views/inc/header.php" ?>
<?= flash('post_message'); ?>
<a href="<?= URLROOT ?>/posts" class="btn btn-light border-dark"><i class='fa fa-backward'></i> back</a>


<div class='mt-4'>
<h1><?= $data['post']->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3 mt-3">
    Written By <?= $data['user']->name; ?> on <?= $data['post']->created_at; ?>
</div>
<p><?= $data['post']->body; ?></p>

<?php if($data['user']->id == $_SESSION['user_id']) : ?>
    <hr>
    <a href="<?= URLROOT ?>/posts/edit/<?= $data['post']->id ?>" class="btn btn-dark">Edit</a>

    <form method='post' action="<?= URLROOT ?>/posts/delete/<?= $data['post']->id ?>" class='float-right'>
        <input type="submit" value="Delete" class='btn btn-danger'>
    </form>
<?php endif; ?>
</div>

<?php require_once APPROOT . "/views/inc/footer.php" ?>