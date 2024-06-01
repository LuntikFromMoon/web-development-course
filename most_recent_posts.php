<div class="most-recent-blocks">
    <img class="landscape" src="<?= $post['image_url'] ?>" alt="<?= $post['title'] ?>">
    <div class="discription">
        <!--<h6 class="discription_title"><?= $post['title'] ?></h6>-->
        <a class="discription_title" title='<?= $post['title'] ?>' href='/post?id=<?= $post['post_id'] ?>'><?= $post['title'] ?></a>
        <p class="discription_subtitle"><?= $post['subtitle'] ?></p>
    </div>
    <div class="author">
        <img class="most-recent__author-img" src="<?= $post['author_url'] ?>" alt="<?= $post['author'] ?>">
            <p class="most-recent__text-style"><?= $post['author'] ?></p>
            <p class="most-recent__text-style data"><?= date("n/d/Y", $post['publish_date']) ?></p>
    </div>
</div>