<?php
/*
 * This is the page users will see logged in.
 * You can edit this, but for upgrade safety you should copy and modify this file into your template folder.
 * The location from within your template folder is plugins/login-with-ajax/ (create these directories if they don't exist)
*/
?>
<div class="lwa">
  <a id="wp-logout" href="<?php echo wp_logout_url(); ?>"><?php esc_html_e('Log Out', 'login-with-ajax'); ?></a>
</div>