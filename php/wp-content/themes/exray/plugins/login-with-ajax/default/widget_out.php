<?php
/*
* This is the page users will see logged out.
* You can edit this, but for upgrade safety you should copy and modify this file into your template folder.
* The location from within your template folder is plugins/login-with-ajax/ (create these directories if they don't exist)
*/
?>
<div class="lwa lwa-default"><?php //class must be here, and if this is a template, class name should be that of template directory ?>
  <h4>Strefa studenta</h4>
  <form class="lwa-form" action="<?php echo esc_attr(LoginWithAjax::$url_login); ?>" method="post">
    <fieldset>
      <input type="hidden" name="lwa_profile_link" value="<?php echo esc_attr($lwa_data['profile_link']); ?>">
      <input type="hidden" name="login-with-ajax" value="login">
      <span class="lwa-status"></span>
      <input type="text" name="log" value="login" class="smart_focus normalcase">
      <input type="password" name="pwd" value="hasło" class="smart_focus normalcase">
      <?php do_action('login_form'); ?>
      <input type="submit" name="wp-submit" id="lwa_wp-submit" value="<?php esc_attr_e('Log In', 'login-with-ajax'); ?>">
      <div class="actions">
        <input name="rememberme" id="rememberme" type="checkbox" class="lwa-rememberme" value="forever">
        <label for="rememberme"><?php esc_html_e('Remember Me','login-with-ajax'); ?></label>
        <?php if (get_option('users_can_register') && !empty($lwa_data['registration'])): ?>
          <a href="<?php echo esc_attr(LoginWithAjax::$url_register); ?>" class="lwa-links-register lwa-links-modal">
            <?php esc_html_e('Register','login-with-ajax'); ?>
          </a>
        <?php endif; ?>
        <?php if(!empty($lwa_data['remember'])): ?>
          <a class="lwa-links-remember" href="<?php echo esc_attr(LoginWithAjax::$url_remember); ?>" title="Zmiana lub przywracanie hasła">
            Zmień hasło
          </a>
        <?php endif; ?>
      </div>
    </fieldset>
  </form>


  <?php if(!empty($lwa_data['remember'])): ?>
  <form class="lwa-remember" action="<?php echo esc_attr(LoginWithAjax::$url_remember) ?>" method="post" style="display:none;">
    <fieldset>
      <input type="hidden" name="login-with-ajax" value="remember">
      <span class="lwa-status"></span>
      <p>Aby zmienić lub odzyskać hasło, wpisz e-mail podany przy rejestracji</p>
      <input type="text" name="user_login" class="lwa-user-remember smart_focus normalcase" value="e-mail">
      <?php do_action('lostpassword_form'); ?>
      <input type="submit" value="OK" class="lwa-button-remember">
      <div class="actions">
        <a href="#" class="lwa-links-remember-cancel"><?php esc_html_e("Cancel", 'login-with-ajax'); ?></a>
      </div>
    </fieldset>
  </form>
  <?php endif; ?>


  <?php if(get_option('users_can_register') && !empty($lwa_data['registration'])): ?>
  <div class="lwa-register lwa-register-default lwa-modal" style="display: none;">
    <h4>Rejestracja</h4>
    <p><!-- . --></p>
    <form class="lwa-register-form" action="<?php echo esc_attr(LoginWithAjax::$url_register); ?>" method="post">
      <fieldset>
        <input type="hidden" name="login-with-ajax" value="register">
        <span class="lwa-status"></span>
        <input type="text" name="user_login" id="user_login" class="smart_focus normalcase" value="nazwa użytkownika">
        <input type="text" name="user_email" id="user_email" class="smart_focus normalcase" value="e-mail">
        <?php do_action('register_form'); ?>
        <?php do_action('lwa_register_form'); ?>
        <input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="<?php esc_attr_e('Register', 'login-with-ajax'); ?>">
      </fieldset>
    </form>
  </div>
  <?php endif; ?>
</div>