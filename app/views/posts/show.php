<?php require APPROOT . '/views/include/header.php'; ?>

<a href="<?php echo URLROOT;?>/posts" class="btn btn-secondary my-3">Back</a>

<main>

    <?php flashMessages('updatePost'); ?>

    <h1><?php echo $data['post']->title?></h1>

    <div class="bg-secondary text-white p-2">
        <span class="">Written by <?php echo $data['user']->name?> on <?php echo $data['post']->created_at; ?></span>
    </div>

    <p>
        <?php echo $data['post']->body?>
    </p>

    <?php if ($data['post']->user_id == $_SESSION['user_id']) : ?>
        <hr>

    <div class="row">
        <div class="col-sm-6 my-1">
            <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id;?>" class="btn btn-warning">Edit</a>
        </div>

        <div class="col-sm-6 my-1">
            <form class="" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id;?>" method="post">
                <input type="submit" value="Delete" class="btn btn-danger">
            </form>
        </div>
    </div>
    <?php endif; ?>

</main>

<?php require APPROOT . '/views/include/footer.php'; ?>
