<!--Footer-->
<?php global $exray_general_options; ?>

<div id="footer-container">
  <footer class="bottom-footer span11" role="contentinfo">
    <!--<ul id="eu_project_logos" class="clearfix">
      <li>
        <img src="/wp-content/themes/exray/images/kapital_ludzki_logo.png" alt="kapitał ludzki">
      </li>
      <li>
        <img src="/wp-content/themes/exray/images/swps_logo_2.png" alt="SWPS">
      </li>
      <li>
        <img src="/wp-content/themes/exray/images/eu_logo.png" alt="Europejski Fundusz Społeczny">
      </li>
    </ul>-->
    <div class="footer-widget-area">
      <div class="row">
        <?php get_sidebar('first-footer') ?>
        <?php get_sidebar('second-footer') ?>
        <?php // get_sidebar('third-footer') ?>
        <?php // get_sidebar('fourth-footer') ?>
      </div>
      <!--End row-->
    </div> 
    <!--End footer-widget-area-->
  </footer> 
  <!--End Footer-->
  <img id="gfx_motif" src="<?php echo esc_url(home_url()); ?>/wp-content/themes/exray/images/motif.png" alt="gfx motif">
</div>
<!--End footer-container-->
</div> 
<!--End page wrap-->
<?php wp_footer(); ?>
<!-- Javascript -->
</body>
</html>