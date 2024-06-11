<?php
    global $post;
    $thumbsize = !isset($args['thumbsize']) ? jobtex_get_config( 'blog_item_thumbsize', 'full' ) : $args['thumbsize'];
    $thumb = jobtex_display_post_thumb($thumbsize);
?>
<article <?php post_class('post post-layout post-grid'); ?>>
    <?php if($thumb) {?>
        <div class="top-image">
            <?php
                echo trim($thumb);
            ?>
         </div>
    <?php } ?>
    <div class="inner-bottom">
        <?php jobtex_post_categories_first($post); ?>
        <?php if (get_the_title()) { ?>
            <h4 class="entry-title">
                <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
                    <div class="stick-icon text-theme"><i class="ti-pin2"></i></div>
                <?php endif; ?>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>
        <?php } ?>

        <div class="top-detail-blog-info d-flex flex-wrap m-0">
            <div class="author">
                <?php echo esc_html__('by','jobtex'); ?>
                <a href="<?php the_permalink(); ?>" class="author-post">
                    <span class="name-author"><?php echo get_the_author(); ?></span>
                </a>
            </div>
            <div>
                <i class="icon-calendar"></i><a href="<?php the_permalink(); ?>"><?php the_time( get_option('date_format', 'd M, Y') ); ?></a>
            </div>
        </div>
    </div>
</article>