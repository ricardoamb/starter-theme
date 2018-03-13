<?php get_header(); ?>

<div id="primary" class="content-area page-template col-md-9 mt-10"><!-- start - #primary -->
    <main id="main" class="site-main"><!-- start - #main -->

<?php
    while ( have_posts() ) :
        the_post();
        get_template_part( 'inc/template-parts/content', 'page' );
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
    endwhile;
?>

    </main><!-- end - #main -->
</div><!-- end - #primary -->

<?php
get_sidebar();
get_footer();
