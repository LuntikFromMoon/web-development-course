
<div class="featured-posts__block">
   <img class="featured-posts_img-modifier" src="<?= $post['image_url'] ?>" alt="<?= $post['title'] ?>">
   <!--<h4 class="featured-posts__title"><a class='featured-posts__title-link' href="#"><?= $post['title'] ?></a></h4> --> 
   <div class="featured-posts__info">
   <h4 class="featured-posts__title"><?= $post['title'] ?></h4>
   <!--<p><a class="featured-posts__subtitle" href='#'> <?= $post['subtitle'] ?> </a></p>-->
   <p><a class="featured-posts__subtitle" title='<?= $post['title'] ?>' href='/post?id=<?= $post['post_id'] ?>'> <?= $post['subtitle'] ?></a></p>
   <!--<p><a class="featured-posts__subtitle" title='<?= $post['title'] ?>' href='/post.php?post_id=<?=$post['post_id']?>'> <?= $post['subtitle'] ?></a></p>-->
   <img class="featured-posts__author-img" src="<?= $post['author_url'] ?>" alt="<?= $post['author'] ?>">
   <h5 class="featured-posts__bottom"> <?= $post['author'] ?> </h5>
   <h5 class="data featured-posts__bottom"> <?= date("F d, Y", $post['publish_date']) ?> </h5>
   </div>
</div>