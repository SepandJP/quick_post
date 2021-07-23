<!-- Import header file -->
<?php require APPROOT . '/views/include/header.php'; ?>


<main class="mt-5">
    <div class="mx-auto mb-1">
        <a href="<?php echo URLROOT;?>/posts/show/<?php echo $data['id'];?>" class="btn btn-warning">Back</a>
    </div>

    <div class="mx-auto bg-light p-2">
        <h1 class="display-5 py-3">Edit Post</h1>

        <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id'];?>" method="post">

            <div class="form-floating m-1 mb-3">
                <input type="text" id="title" name="title" class="form-control <?php echo (!empty($data['title_error'])) ? ' is-invalid ' : ''; ?>" placeholder="Title" value="<?php echo $data['title']; ?>">
                <label for="title" class="form-label">Title</label>
                <span class="invalid-feedback"><?php echo $data['title_error']; ?></span>
            </div>

            <div class="form-floating m-1">
                <textarea name="body" id="body" style="height: 10em;" class="form-control form-control-lg<?php echo (!empty($data['body_error'])) ? ' is-invalid ' : ''?>" placeholder="Body"><?php echo $data['body'];?></textarea>
                <label for="body" class="form-label">body</label>
                <span class="invalid-feedback"><?php echo $data['body_error']; ?></span>
            </div>

            <div class="">
                <div class="mx-auto mt-3 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                    <button type="submit" class="btn btn-success rounded-pill w-100">Edit Post</button>
                </div>
            </div>

        </form>
    </div>
</main>


<!-- Import footer file -->
<?php require APPROOT . '/views/include/footer.php'; ?>

