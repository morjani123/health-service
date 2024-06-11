<?php
global $post;
$post_format = get_post_format();
$single_style = !isset($args['single_style']) ? jobtex_get_config('blog_single_style') : $args['single_style'];
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if($single_style == 'v1'){ ?>
        <div class="entry-blog-header-v1 text-center">
            <?php jobtex_post_categories($post); ?>
            <?php if (get_the_title()) { ?>
                <h1 class="entry-title">
                    <?php the_title(); ?>
                </h1>
            <?php } ?>
            <div class="top-detail-blog-info d-flex flex-wrap justify-content-center">
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
    <?php } else { ?>
        <?php get_template_part( 'template-posts/single/header' ); ?>
    <?php } ?>
    <div class="top-content-detail-blog">

            <div class="entry-content-detail <?php echo esc_attr((!has_post_thumbnail())?'not-img-featured':'' ); ?>">
                
                <div class="single-info info-bottom">
                    <div class="entry-description">
                        <?php the_content(); ?>
                    </div><!-- /entry-content -->
                    
                    <?php
                    wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'jobtex' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'jobtex' ) . ' </span>%',
                        'separator'   => '',
                    ) );
                    ?>

                    <?php  
                        $posttags = get_the_tags();
                    ?>
                    <?php if( !empty($posttags) || jobtex_get_config('show_blog_social_share', false) ){ ?>
                        <div class="tag-social d-md-flex align-items-center w-100">
                            <?php if(!empty($posttags)){ ?>
                                <?php jobtex_post_tags(); ?>
                            <?php } ?>
                            <?php if ( jobtex_get_config('show_blog_social_share', false) ) { ?>
                                <div class="ms-auto">
                                    <?php get_template_part( 'template-parts/sharebox' ); ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    
                    <?php 
                    //Previous/next post navigation.
                    the_post_navigation( array(
                        'next_text' => 
                            '<div class="inner">'.
                            '<div class="navi">'. esc_html__( 'Next', 'jobtex' ) . '</div>'.
                            '<span class="title-direct">%title</span></div>',
                        'prev_text' => 
                            '<div class="inner">'.
                            '<div class="navi">' . esc_html__( 'Previous', 'jobtex' ) . '</div>'.
                            '<span class="title-direct">%title</span></div>',
                    ) );
                    ?>

                </div>
            </div>

            <?php
            get_template_part( 'template-posts/single/author-bio' );

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }

            ?>

    </div>
</article>