<?php
$thumbsize = empty($args['thumbsize']) ? jobtex_get_config( 'blog_item_thumbsize', 'full' ) : $args['thumbsize'];
?>
<div class="layout-posts-list">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'template-posts/loop/inner-list', null, array('thumbsize' => $thumbsize) ); ?>
    <?php endwhile; ?>
</div>