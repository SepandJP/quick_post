<?php require APPROOT . '/views/include/header.php'; ?>

<div class="row">

    <div class="col-md-3 m-2">
        <a href = " <?php echo URLROOT . '/posts/add'; ?> " type="button" class="btn btn-primary">Add post</a>
    </div>

    <div class="col-md-6">

        <div class="mt-2">
            <?php flashMessages('addPost'); ?>
            <?php flashMessages('deletePost'); ?>
        </div>

        <h1>Posts</h1>


        <div>
            <?php foreach ($data['posts'] as $post) : ?>
            <a href="<?php echo URLROOT;?>/posts/show/<?php echo $post->postId;?>">
                <div class="card my-1">
                    <div class="card-body">
                        <div class="card-header">
                            <h4 class="card-title"><?php echo $post->title; ?></h4>
                            <span class="card-subtitle text-muted"><em>Written by <?php echo $post->userName?> on <?php echo $post->postCreated?></em></span>
                        </div>
                        <h5 class="card-subtitle mb-2 text-muted"><?php //todo add description (in DB and model after that in here) ?></h5>
                        <p class="card-text">
                            <?php echo $post->body; ?>
                        </p>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

    </div>

</div>


<?php require APPROOT . '/views/include/footer.php'?>


