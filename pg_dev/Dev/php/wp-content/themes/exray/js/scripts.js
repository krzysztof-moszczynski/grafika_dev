/*global jQuery */
/*!
* FitVids 1.0
*
* Copyright 2011, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
* Date: Thu Sept 01 18:00:00 2011 -0500
*/

(function( $ ){

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null
    }

    var div = document.createElement('div'),
        ref = document.getElementsByTagName('base')[0] || document.getElementsByTagName('script')[0];

    div.className = 'fit-vids-style';
    div.innerHTML = '&shy;<style>         \
      .fluid-width-video-wrapper {        \
         width: 100%;                     \
         position: relative;              \
         padding: 0;                      \
      }                                   \
                                          \
      .fluid-width-video-wrapper iframe,  \
      .fluid-width-video-wrapper object,  \
      .fluid-width-video-wrapper embed {  \
         position: absolute;              \
         top: 0;                          \
         left: 0;                         \
         width: 100%;                     \
         height: 100%;                    \
      }                                   \
    </style>';

    ref.parentNode.insertBefore(div,ref);

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        "iframe[src*='player.vimeo.com']",
        "iframe[src*='www.youtube.com']",
        "iframe[src*='www.kickstarter.com']",
        "object",
        "embed"
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var $allVideos = $(this).find(selectors.join(','));

      $allVideos.each(function(){
        var $this = $(this);
        if (this.tagName.toLowerCase() == 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        var height = ( this.tagName.toLowerCase() == 'object' || $this.attr('height') ) ? $this.attr('height') : $this.height(),
            width = $this.attr('width') ? $this.attr('width') : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('id')){
          var videoID = 'fitvid' + Math.floor(Math.random()*999999);
          $this.attr('id', videoID);
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');
      });
    });
  }

  jQuery('#menu-left-menu-strefa-studenta > li:nth-child(1) > a').click(function(event) {       // very custom selector (strefa studenta)
    event.preventDefault();
    jQuery('#menu-left-menu-strefa-studenta > li:nth-child(1) > a ~ ul').toggle('fast');
  });
  jQuery('#menu-left-menu-strefa-studenta > li:nth-child(1) > ul > li:nth-child(2) > a').click(function(event) {       // very custom selector (pliki do pobrania)
    event.preventDefault();
    jQuery('#menu-left-menu-strefa-studenta > li:nth-child(1) > ul > li:nth-child(2) > a ~ ul').toggle('fast');
  });
  jQuery('#menu-primary-navigation > li:nth-child(2) > a').click(function(event) {       // very custom selector (studia)
    event.preventDefault();
    jQuery('#menu-primary-navigation > li:nth-child(2) > a ~ ul').toggle('fast');
  });
  jQuery('#menu-primary-navigation > li:nth-child(3) > a').click(function(event) {       // very custom selector (ludzie)
    event.preventDefault();
    jQuery('#menu-primary-navigation > li:nth-child(3) > a ~ ul').toggle('fast');
  });
  jQuery('#menu-primary-navigation > li:nth-child(3) > ul > li:nth-child(2) > a').click(function(event) {       // very custom selector (ludzie/studenci)
    event.preventDefault();
    jQuery('#menu-primary-navigation > li:nth-child(3) > ul > li:nth-child(2) > a ~ ul').toggle('fast');
  });
  jQuery('#menu-primary-navigation > li:nth-child(5) > a').click(function(event) {       // very custom selector (prace)
    jQuery('#menu-primary-navigation > li:nth-child(5) > a ~ ul').toggle('fast');
  });
})( jQuery );

jQuery(document).ready(function(){
	/* Clone and Append menu content to Adaptive menu */
	jQuery('.top-menu-navigation ul:first-child').clone().appendTo('.adaptive-top-nav');

	jQuery('.main-menu-navigation ul:first-child').clone().appendTo('.adaptive-main-nav');

	/*	Slide Adaptive menu when Menu button clicked	*/
 	jQuery('#adaptive-top-nav-btn').click(function(event){
 		event.preventDefault();
 		jQuery('.adaptive-top-nav').slideToggle();
 	});

 	jQuery('#adaptive-main-nav-btn').click(function(event){
 		event.preventDefault();
 		jQuery('.adaptive-main-nav').slideToggle();
 	});

 	jQuery('.video-container').fitVids();
  // initialize scrollable
  jQuery("#home_top.scrollable").scrollable({
    'prev': '#scroll_nav_home_top .prev',
    'next': '#scroll_nav_home_top .next',
    'touch': false
  });
  jQuery("#home_news.scrollable").scrollable({
    'prev': '#scroll_nav_home_news .prev',
    'next': '#scroll_nav_home_news .next',
    'touch': false
  });
  jQuery("#latest_publications.scrollable").scrollable({
    'prev': '#scroll_nav_latest_publications .prev',
    'next': '#scroll_nav_latest_publications .next',
    'touch': false
  });
  jQuery("#the_crew.scrollable").scrollable({
    'prev': '#scroll_nav_the_crew .prev',
    'next': '#scroll_nav_the_crew .next',
    'circular': true,
    'touch': false
  });
  jQuery("#program_speciality_list.scrollable").scrollable({
    'prev': '#scroll_nav_program_speciality_list .prev',
    'next': '#scroll_nav_program_speciality_list .next',
    'keyboard': false,
    'touch': false
  });
  jQuery("#alums.scrollable").scrollable({
    'prev': '#scroll_nav_alums .prev',
    'next': '#scroll_nav_alums .next',
    'touch': false
  });
  jQuery("#didactics_rules_list.scrollable").scrollable({
    'prev': '#scroll_nav_didactics_rules_list .prev',
    'next': '#scroll_nav_didactics_rules_list .next',
    'touch': false
  });
  jQuery("#efforts_slider.scrollable").scrollable({
    'prev': '#scroll_nav_efforts_slider .prev',
    'next': '#scroll_nav_efforts_slider .next',
    'touch': false
  });
  jQuery("#class_slider.scrollable").scrollable({
    'prev': '#scroll_nav_class_slider .prev',
    'next': '#scroll_nav_class_slider .next',
    'touch': false
  });
  jQuery("#applicants_top.scrollable").scrollable({
    'prev': '#scroll_nav_applicants_top .prev',
    'next': '#scroll_nav_applicants_top .next',
    'touch': false
  });
  jQuery("#gallery.scrollable").scrollable({
    'prev': '#scroll_nav_gallery .prev',
    'next': '#scroll_nav_gallery .next',
    'keyboard': false,
    'touch': false
  });


  jQuery("#gallery.scrollable .ngg-clear").remove();
  jQuery("#didactics_rules_list .title a").addClass('no-link');

  // jQuery ui dialog for alums
  jQuery('.popup').click(function(e){
    e.stopPropagation();
    var _this = jQuery(this);
    var popup_title = _this.attr('title');
    var popup_content = _this.html();
    if (jQuery('#DialogBoxAlums').length == 0) {
      jQuery('body').append('<div id="DialogBoxAlums" class="dialog_box" title="dialog title"><!-- . --><\/div>');
      var DialogBox = jQuery('#DialogBoxAlums');
      DialogBox.dialog({
        'autoOpen'  : false,
        'minWidth'  : 340,
        'minHeight' : 240,
        'modal'     : true,
        'closeText' : 'Zamknij',
        'draggable' : false
      });
    } else {
      var DialogBox = jQuery('#DialogBoxAlums');
    }
    DialogBox.html(popup_content);
    if (!DialogBox.dialog('isOpen')) {
      DialogBox.dialog('option', 'title', popup_title);
      DialogBox.dialog('open');
    }
    return false;
  });


  // prevent links with href="#no-link"
  jQuery('a[href*="#no-link"], a.no-link').click(function(e){
    e.stopPropagation();
    return false;
  });


  var team_desctiption = jQuery('#TeamDescription');
  jQuery('#Team li').hover(function() {
    var desc = jQuery(this).children('.desc').html();
    team_desctiption.html(desc);
  }, function() {
    var desc = jQuery(this).children('.desc').html();
    team_desctiption.empty();
  });


  function check_email(email_address) {
    if (email_address.match(/^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/) == null) {
      return false;
    }
    return true;
  }
  var newsletter_email = jQuery('.newsletter-email');
  newsletter_email.keyup(function() {
    if (check_email(newsletter_email.val())) {
      newsletter_email.removeClass('not_valid').addClass('valid');
      jQuery('#NewsletterForm input[type="submit"]').removeAttr('disabled');
    } else {
      newsletter_email.removeClass('valid').addClass('not_valid');
      jQuery('#NewsletterForm input[type="submit"]').attr('disabled', 'disabled');
    }
  });


  jQuery('.zq_fancybox').fancybox({
    'prevEffect' : 'fade',
    'nextEffect' : 'fade',
    helpers: {
      'title' : null
    }
  });


  jQuery(function() {
    jQuery('.accordion').accordion({
      'heightStyle'   : "content",
      'collapsible'   : true,
      'active'        : false
    });
  });

  var right_context_column_trigger = jQuery('<a/>', {
    'id'          : 'right_context_column_trigger',
    'class'       : 'no_hover',
    'href'        : '#'
  })
  .click(function(event) {
    event.preventDefault();
    jQuery(this).parent().toggleClass('expanded');
  });
  jQuery('#main-container #secondary').prepend(right_context_column_trigger);

  var left_context_column_trigger = jQuery('<a/>', {
    'id'          : 'left_context_column_trigger',
    'class'       : 'no_hover',
    'href'        : '#'
  })
  .click(function(event) {
    event.preventDefault();
    jQuery(this).parent().toggleClass('expanded');
  });
  jQuery('#main-container #primary').prepend(left_context_column_trigger);


  // FIXME: zq dirty hack for highlight parent post categories on primary menu
  jQuery('.current-menu-ancestor').parents('.menu-item').addClass('current-menu-ancestor');
  // END FIXME
});

jQuery(window).load(function() {

  var dispose_content = function() {
    var clientWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

    if ((clientWidth > 692) && (clientWidth < 1278)) {
      jQuery('.scrollable:not(.asymmetric_list, .full_width_slider) .span3').width(function() {             // scrollable symetric (aktualnosci @ home)
        var parent_container_width = jQuery(this).parents('.scrollable').width();
        return (parent_container_width / 3 - 10);
      });
      jQuery('.asymmetric_list.scrollable .items li').width(function() {
        var parent_container_width = jQuery(this).parents('.scrollable').width();
        return (parent_container_width / 3 - 15);
      });
      jQuery('.asymmetric_list.scrollable .items li:nth-child(2n+1)').width(function() {
        var parent_container_width = jQuery(this).parents('.scrollable').width();
        return (parent_container_width / 3 * 2);
      });
    }

    if (clientWidth < 693) {
      jQuery('.scrollable .span3').width(function() {             // scrollable symetric (aktualnosci @ home)
        var parent_container_width = jQuery(this).parents('.scrollable').width();
        return parent_container_width;
      });
      jQuery('.asymmetric_list.scrollable .items li').width(function() {
        var parent_container_width = jQuery(this).parents('.scrollable').width();
        return parent_container_width;
      });
      jQuery('.asymmetric_list.scrollable .items li:nth-child(2n+1)').width(function() {
        var parent_container_width = jQuery(this).parents('.scrollable').width();
        return parent_container_width;
      });
    }

    if (clientWidth < 1278) {
      jQuery('.scrollable.full_width_slider li').width(function() {                 // full width slider (home_top)
        var parent_container_width = jQuery(this).parents('.scrollable').width();
        return parent_container_width;
      });
      jQuery('.ngg-gallery-thumbnail-box, .ngg-gallery-thumbnail-box img').width(function() {
        var parent_container_width = jQuery(this).parents('.scrollable').width();
        return parent_container_width;
      });
      // reset each .scrollable position to the first visible element
      jQuery('.scrollable').each(function() {
        // calculate height
        var scrollable_content_height = 0;
        jQuery(this).children().each(function() {
          scrollable_content_height += jQuery(this).outerHeight(true);
        });

        // reset each .scrollable position to the first visible element
        jQuery(this).height(scrollable_content_height); 
        var scrollable_instance = jQuery(this).data('scrollable');
        var index = scrollable_instance.getIndex();
        scrollable_instance.seekTo(index, 0);
      });
    }
  }

  jQuery(window).resize(function() {
    dispose_content();
  });

  dispose_content();
});
