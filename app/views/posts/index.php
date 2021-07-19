<?php require APPROOT . '/views/include/header.php'; ?>

<div class="row">

    <div class="col-md-3 m-2">
        <a href="<?php URLROOT . '/posts/add'; ?>" type="button" class="btn btn-primary">Add post</a>
    </div>

    <div class="col-md-6">
        <h1>Posts</h1>


        <div>
            <?php foreach ($data['posts'] as $post) : ?>
                <div class="card">
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
            <?php endforeach; ?>
        </div>

    </div>

</div>


<?php require APPROOT . '/views/include/footer.php'?>


