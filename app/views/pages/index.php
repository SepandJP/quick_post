<?php require APPROOT . '/views/include/header.php'; ?>

<h1> <?php echo $data['title'] ?> </h1>
<p>This is a PHP framework for learning MVC in PHP.</p>
<p>Please refer to the docs on how to use it</p>
<p><?php //todo delete this (Link) ?></p>

<?php require APPROOT . '/views/include/footer.php'; ?>


<!-- main content -->

<div class="jumbotron jumbotron-flud text-center">
    <div class="container">
        <h1 class="display-3"><?php echo $data['title']; ?></h1>
        <p class="lead"><?php echo $data['description']; ?></p>
    </div>
</div>