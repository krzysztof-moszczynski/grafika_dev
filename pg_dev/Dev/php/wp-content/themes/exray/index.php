<?php get_header(); ?>
<!-- Main Content -->
<div class="container" id="main-container">

    <div class="row">

        <?php get_exray_primary_sidebar(); ?>
        <div class="span1 spacer"><!-- spacer --></div>
        <?php get_exray_content_html_opening(); ?>

            <div class="content" role="main">
                <!-- The Loop of Post -->
                <?php if (have_posts()) : while (have_posts()): the_post(); ?>

                        <!-- If template part content exist, show post format content items -->
                        <?php get_template_part('content', get_post_format()); ?>

                    <?php endwhile;
                else : ?>
                    <!-- If no Post Found -->
                    <h1><?php _e("No post were Found", "exray-framework") ?></h1>

<?php endif; ?>

                <!-- Pagination for older / newer post -->
                <nav class="pagination clearfix"  id="nav-below" role="navigation">

                    <p class="article-nav-prev"><?php next_posts_link(__('&larr; Starsze posty', 'exray-framework')); ?></p>
                    <p class="article-nav-next"><?php previous_posts_link(__('Nowsze posty &rarr; ', 'exray-framework')); ?></p>

                </nav>
                <!-- End nav-below -->

                <!-- End nav-below -->
            </div> 
            <!-- end content -->
        </div> 
        <!-- end span6 main -->	 
        <div class="span1 spacer"><!-- spacer --></div>
        <?php get_exray_secondary_sidebar(); ?>   

    </div> 
    <!--End row -->

</div>
<!-- End Container  -->
<!-- End Main Content -->

<?php get_footer(); ?>