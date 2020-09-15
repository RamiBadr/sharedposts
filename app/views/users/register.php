<?php require_once APPROOT . "/views/inc/header.php" ?>


    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2>Create an account</h2>
                <p>Please fill up this form to register with us.</p>
                <form method='post' action="<?=URLROOT?>/users/register" novalidate>
                    <div class="form-group">
                        <label for="name">Name: <sup>*</sup></label>
                        <input type="text" name="name" id='name' class='form-control 
                        <?= !empty($data['name_err'])? 'is-invalid' : '' ?>' value="<?=$data['name']?>">
                        <span class="invalid-feedback <?= !empty($data['name_err'])? 'd-block' : '' ?>"><?= $data['name_err'] ?></span>
                    </div>
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
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password: <sup>*</sup></label>
                        <input type="password" name="confirm_password" id='confirm_password' class='form-control
                        <?= !empty($data['confirm_password_err'])? 'is-invalid' : '' ?>' value="<?=$data['confirm_password']?>">
                        <span class="invalid-feedback <?= !empty($data['confirm_password_err'])? 'd-block' : '' ?>"><?= $data['confirm_password_err'] ?></span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="Register" name='register' class='btn btn-primary btn-block'>
                        </div>
                        <div class="col">
                            <a href='<?=URLROOT?>/users/login' class='btn btn-danger btn-block'>Have an account? Login</a>
                        </div>
                </form>
            </div>
        </div>
    </div>


<?php require_once APPROOT . "/views/inc/footer.php" ?>