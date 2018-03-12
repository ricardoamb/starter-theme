<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

<?php
    while ( have_posts() ) :
        the_post();

        get_template_part( 'inc/template-parts/content', 'page' );
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;

    endwhile;
?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
