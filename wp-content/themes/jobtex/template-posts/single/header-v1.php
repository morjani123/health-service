<?php
global $post;
?>
<div class="entry-thumb-detail-v1 text-center">
<?php
    $thumb = jobtex_post_thumbnail('1920x600');
    if ( $thumb ) { ?>
        <?php echo trim($thumb); ?>
<?php } ?>
</div>