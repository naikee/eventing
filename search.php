<?php get_header(); ?>

<section id="main" class="container">
    <div class="row">
        <div id="content" class="site-content col-md-12" role="main">

            <?php if ( have_posts() ) : ?>

                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'templates/post-format/content', get_post_format() ); ?>
                <?php endwhile; ?>

                <?php echo adeetheming_pagination(); ?>

            <?php else: ?>
                <?php get_template_part( 'templates/post-format/content', 'none' ); ?>
            <?php endif; ?>

        </div> <!-- #content -->

    </div>
</section>
<?php get_footer();