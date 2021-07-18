<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none navbar-brand">
                <div class="navbar-brand">
                    <a href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?>
                        <i class="bi bi-bootstrap-fill" style="font-size: 2rem; color: darkcyan"></i>
                    </a>
                </div>

            </a>


            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="<?php echo URLROOT; ?>" class="nav-link px-2 text-secondary">Home</a></li>
                <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
                <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
                <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
                <li><a href="<?php echo URLROOT; ?>/pages/about" class="nav-link px-2 text-white">About</a></li>
            </ul>

<!--            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">-->
<!--                <input type="search" class="form-control form-control-dark" placeholder="Search...">-->
<!--            </form>-->

            <div class="text-end">
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <a href="<?php echo URLROOT;?>/users/logout" type="button" class="btn btn-danger">Log out</a>
                <?php else : ?>
                <a href="<?php echo URLROOT;?>/users/login" type="button" class="btn btn-outline-light me-2">Login</a>
                <a href="<?php echo URLROOT;?>/users/register" type="button" class="btn btn-warning">Sign-up</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>



