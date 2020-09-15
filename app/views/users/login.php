<?php require_once APPROOT . "/views/inc/header.php" ?>


    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card card-body bg-light mt-5">
            <?= flash('success_message');?>
                <h2>Login</h2>
                <p>Please fill up your credentials to login.</p>
                <form method='post' action="<?=URLROOT?>/users/login" novalidate>
                    <div class="form-group">
                        <label for="email">Email: <sup>*</sup></label>
                        <input type="email" name="email" id='email' class='form-control
                        <?= !empty($data['email_err'])? 'is-invalid' : '' ?>' value="<?=$data['email']?>">
                        <span class="invalid-feedback <?= !empty($data['email_err'])? 'd-block' : '' ?>"><?= $data['email_err'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password: <sup>*</sup></label>
                        <input type="password" name="password" id='password' class='form-control
                        <?= !empty($data['password_err'])? 'is-invalid' : '' ?>' value="<?=$data['password']?>">
                        <span class="invalid-feedback <?= !empty($data['password_err'])? 'd-block' : '' ?>"><?= $data['password_err'] ?></span>
                    </div>
                        <div class="row">
                            <div class="col">
                                <input type="submit" value="Login" name='login' class='btn btn-primary btn-block'>
                            </div>
                            <div class="col">
                                <a href="<?=URLROOT?>/users/register"" class="btn btn-danger btn-block">No account? Register.</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



<?php require_once APPROOT . "/views/inc/footer.php" ?>