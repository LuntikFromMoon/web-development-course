<!-- class="main-info" -->
<!-- main-block__info -->
<main class="MainInfo">
        <h1> <?= $post['post_id'] ?> <?= $post['title'] ?></h1>
        <h2><?= $post['subtitle'] ?></h2>
        <img class="MainImg" src="<?= $post['image_url'] ?>" alt="<?= $post['title'] ?>"> 
        <p>
            <?= $post['content'] ?>
        </p>
    </main> 