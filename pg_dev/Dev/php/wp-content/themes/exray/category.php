<?php get_header(); ?>

<!-- Main Content -->
<div class="container" id="main-container">
  <div class="row">
    <?php get_exray_primary_sidebar(); ?>
    <div class="span1 spacer"><!-- spacer --></div>
    <?php get_exray_content_html_opening(); ?>
      
      <?php Exray::load_breadcrumb(); ?>

      <div class="content" role="main">
        <?php if(have_posts()) : ?>
            <div class="top-content">
              <h4><strong><?php single_cat_title('', true ); ?></strong></h4>
            </div>

          <?php while(have_posts()) : the_post(); ?>
            <!-- The Loop of Post -->
            <?php get_template_part('content', get_post_format()); ?>
            
            <!-- If post format content, show post format content items -->
            
          <?php endwhile; else :  ?>
            <!-- If no Post Found -->
            <div class="top-content">
              <h4><strong>Brak wyników wyszukiwania</strong></h4>
            </div>

          <?php endif; ?>
        <!-- Pagination for older/newer post -->
        <?php // get_exray_pagination(); ?>
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