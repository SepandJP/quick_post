<!-- Import header file -->
<?php require APPROOT . '/views/include/header.php'; ?>


<main class="row mt-5">
    <div class="mx-auto col-md-6 bg-light">
        <h1 class="display-5 py-3">Create An Account</h1>

        <form action="<?php echo URLROOT; ?>/users/register" method="post">

            <div class="form-floating m-1">
                <input type="text" name="username" id="username" class="form-control <?php echo (!empty($data['username_error'])) ? 'is-invalid' : ''; ?>" placeholder=" " value="<?php echo $data['username']; ?>">
                <label for="username" class="col-form-label">Username</label>
                <span class="invalid-feedback"><?php echo $data['username_error']; ?></span>
            </div>

            <div class="form-floating m-1">
                <input type="email" name="email" id="email" class="form-control <?php echo (!empty($data['email_error'])) ? 'is-invalid' : ''; ?>" placeholder=" " value="<?php echo $data['email']; ?>">
                <label for="email" class="form-label">Email</label>
                <span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
            </div>

            <div class="form-floating m-1">
                <input type="password" name="password" id="password" class="form-control <?php echo (!empty($data['password_error'])) ? 'is-invalid' : ''; ?>" placeholder=" " value="<?php echo $data['password']; ?>">
                <label for="password" class="form-label">Password</label>
                <span class="invalid-feedback"><?php echo $data['password_error']; ?></span>
            </div>

            <div class="form-floating m-1">
                <input type="password" name="confirm_password" id="confirm_password" class="form-control <?php echo (!empty($data['confirm_password_error'])) ? 'is-invalid' : ''; ?>" placeholder=" " value="<?php echo $data['confirm_password']; ?>">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <span class="invalid-feedback"><?php echo $data['confirm_password_error']; ?></span>
            </div>

            <div class="px-0 mx-0 row m-2 d-flex">
                <div class="mt-3 col-sm-5 col-md-5 col-lg-7 col-xl-8">
                    <button type="submit" class="btn btn-success rounded-pill w-100">Sign up</button>
                </div>

                <div class="col-12 col-sm-5 col-md-7 col-lg-5 col-xl-4 mt-3 float-end">
                    <div class="row bg-secondary rounded-pill">
                        <a href="<?php echo URLROOT; ?>/users/login" class="btn">
                            <div class="col">
                                <span>
                                    <em>Have you an account?</em>
                                </span>
                            </div>
                                Login
                        </a>
                    </div>
                </div>
            </div>

        </form>
    </div>
</main>


<!-- Import footer file -->
<?php require APPROOT . '/views/include/footer.php'; ?>

