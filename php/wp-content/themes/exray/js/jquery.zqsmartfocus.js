function SmartFocus() {
  // get default value from each form field (.smart_focus) and store in field object variable
  jQuery('.smart_focus').each(function() {
    this.field_default_value = jQuery(this).val();
    jQuery(this).addClass('default');

    // protect parent form from submiting when default value is set
    var field = this;
    jQuery(this).parents('form').submit(function() {
      if(field.field_default_value == jQuery(field).val()) {
        return false;
      }
    });
  });

  jQuery('.smart_focus').focus(function() {
    jQuery(this).removeClass('default');
    if (jQuery(this).val() == this.field_default_value) {
      jQuery(this).val('');
    }
  });

  jQuery('.smart_focus').blur(function() {
    if (jQuery(this).val() == '') {
      jQuery(this).val(this.field_default_value).addClass('default');
    }
  });
}

jQuery(document).ready(function(jQuery) {
  SmartFocus();
});
