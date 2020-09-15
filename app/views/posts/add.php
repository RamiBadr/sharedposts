<?php require_once APPROOT . "/views/inc/header.php" ?>
    
    
    <a href="<?= URLROOT ?>/posts" class="btn btn-light border-dark"><i class='fa fa-backward'></i> back</a>
        <div class="card card-body bg-light mt-5">
        <?= flash('success_message');?>
            <h2>Add Post.</h2>
            <p>Create a post with this form.</p>
            <form method='post' action="<?=URLROOT?>/posts/add" novalidate>
                <div class="form-group">
                    <label for="title">Title: <sup>*</sup></label>
                    <input type="text" name="title" id='title' class='form-control
                    <?= !empty($data['title_err'])? 'is-invalid' : '' ?>' 
                    value="<?= !empty($data['title_err']) || !empty($data['body_err'])?$data['title'] : '' ?>">
                    <span class="invalid-feedback <?= !empty($data['title_err'])? 'd-block' : '' ?>"><?= $data['title_err'] ?></span>
                </div>
                <div class="form-group">
                    <label for="body">Body: <sup>*</sup></label>
                    <textarea name="body" id="body" cols="30" rows="10" 
                    class='form-control <?= !empty($data['body_err'])? 'is-invalid' : '' ?>''>
                        <?= !empty($data['title_err']) || !empty($data['body_err'])? $data['body'] : '' ?>
                    </textarea>
                    <span class="invalid-feedback <?= !empty($data['body_err'])? 'd-block' : '' ?>"><?= $data['body_err'] ?></span>
                </div>
                <input class='btn btn-primary' type="submit" value="Add Post">
            </form>
        </div>       
    </div>

<?php require_once APPROOT . "/views/inc/footer.php" ?>
