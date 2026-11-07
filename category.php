<?php get_header(); ?>

<section id="main">
    
    <div class="container">
        <div class="row">
            <div id="content" class="site-content col-md-12" role="main">

                <?php if ( have_posts() ) : ?>

                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'templates/post-format/content', get_post_format() ); ?>
                    <?php endwhile; ?>

                    <?php adeetheming_pagination(); ?>

                <?php else: ?>
                    <?php get_template_part( 'templates/post-format/content', 'none' ); ?>
                <?php endif; ?>

            </div> <!-- #content -->

        </div> <!-- .row -->
    </div> <!-- .contaainer -->
    
</section> 

<?php get_footer();