<?php
global $post;
?>
<div class="entry-blog-header">
    <?php jobtex_post_categories($post); ?>
    <?php if (get_the_title()) { ?>
        <h1 class="entry-title">
            <?php the_title(); ?>
        </h1>
    <?php } ?>

    <div class="top-detail-blog-info d-flex flex-wrap">
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
<?php
    $thumb = jobtex_post_thumbnail();
    if ( $thumb ) { ?>
        <div class="entry-thumb-detail">
            <?php echo trim($thumb); ?>
        </div>
<?php } ?>