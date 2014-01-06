<?php
/***************************************************************/
/* Define Constant */
/***************************************************************/
define( 'HOME_URI', home_url() );
define( 'THEME_URI', get_template_directory_uri() );
define( 'THEME_IMAGES', THEME_URI . '/images' );
define( 'THEME_CSS', THEME_URI . '/css' );
define( 'THEME_JS', THEME_URI . '/js' );

/***************************************************************/
/* Exray class */
/***************************************************************/
require 'classes/exray.php';

/***************************************************************/
/* Theme template / parts */
/***************************************************************/
require ('functions/exray-theme-template.php');
require ('functions/exray-theme-customizer.php');
require ('functions/exray-theme-stylesheet.php');
require ('functions/exray-theme-options.php');

/* Global Variable */
$exray_general_options = get_option('exray_theme_general_options');
$exray = new Exray;

$exray->set_max_content_width(542);
$exray->get_max_content_width();
$exray->set_aside_symbol(true);

/***************************************************************/
/* Add Post Thumbnail and Post Format Theme Support*/
/***************************************************************/
add_action( 'after_setup_theme', 'exray_setup' );

function exray_setup(){
	add_theme_support('post-formats', array('link', 'quote', 'gallery', 'aside'));
	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails', array('post'));
	set_post_thumbnail_size( 150, 150, true);	// Post Thumbnail default size 	
	load_theme_textdomain( 'exray-framework', THEME_URI. '/languages' );
	
	register_nav_menus(
		array(
		  'top-menu' => __( 'Top Menu', 'exray-framework' ),
		  'main-menu' => __( 'Main Menu', 'exray-framework' )
		)
	);
}

/***************************************************************/
/* Enqueu scripts and stylesheet */
/***************************************************************/
add_action('wp_enqueue_scripts', 'exray_scripts_styles');

function exray_scripts_styles(){
	wp_enqueue_style( 'style.css', get_stylesheet_uri(),'', false, 'all' );
	wp_enqueue_script( 'custom_scripts', THEME_JS . '/scripts.js', array('jquery'), false, true );
}

/***************************************************************/
/* Creates a more specific title element text  */
/***************************************************************/
function exray_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'exray-framework' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'exray_wp_title', 10, 2 );


function pbase_custom_css() {
  echo '<link rel="stylesheet" href="' . THEME_CSS . '/smoothness/jquery-ui-1.10.3.custom.min.css?ver=3.6" type="text/css" media="screen, projection">';
  echo '<link rel="stylesheet" href="' . THEME_CSS . '/pbase.css" type="text/css" media="screen, projection">';
  echo '<link rel="stylesheet" href="' . THEME_CSS . '/project_specific.css" type="text/css" media="screen, projection">';
  echo '<link rel="stylesheet" href="/wp-includes/js/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen, projection">';
}
add_action('wp_head', 'pbase_custom_css');

function pk_custom_js() {
  echo '<script type="text/javascript" src="' . THEME_JS . '/jquery.tools.min.js"></script>';
  echo '<script type="text/javascript" src="' . THEME_JS . '/jquery-ui-1.10.3.custom.min.js"></script>';
  echo '<script type="text/javascript" src="' . THEME_JS . '/jquery.zqsmartfocus.js"></script>';
  echo '<script type="text/javascript" src="/wp-includes/js/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>';
  echo '<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>';
  echo '<script type="text/javascript" src="//use.typekit.net/xtm0mmg.js"></script>';
  echo '<script type="text/javascript">try{Typekit.load();}catch(e){}</script>';
}
// Add hook for admin <head></head>
// add_action('admin_head', 'my_custom_js');
// Add hook for front-end <head></head>
add_action('wp_head', 'pk_custom_js');

function add_query_vars_filter($vars) {
  $vars[] = "filter";
  $vars[] = "ppno";
  return $vars;
}
add_filter('query_vars', 'add_query_vars_filter');

function check_can_display($post_id) {
  $is_members_only = get_post_meta($post_id, '_wpac_is_members_only', true);
  return (is_user_logged_in() || !(bool)$is_members_only);
}

function insert_pagination($found_posts, $posts_per_page, $actual_page) {
  if ($found_posts <= $posts_per_page) {
    return '';
  }
  $actual_page = (int)$actual_page;
  $pagination_pages_no = floor($found_posts / $posts_per_page) + (int)(bool)($found_posts % $posts_per_page) + 1;
  $ret = '<ul class="custom_pagination span3 clearfix">';
  for ($i = 1; $i < $pagination_pages_no; ++$i) {
    if ($i === $actual_page) {
      $ret .= '<li><span>' . $i . '</span></li>';
    } else {
      $query_string = $_SERVER['QUERY_STRING'] . '&ppno=' . $i;
      parse_str($query_string, $arr);
      $query_string = http_build_query($arr);
      $ret .= '<li><a href="?' . $query_string  . '">' . $i . '</a></li>';
    }
  }
  $ret .= '</ul>';
  return $ret;
}

function get_post_top_parent_category($post_id) {
  $categories = wp_get_post_categories($post_id);
  foreach ($categories as $category_id) {
    $category = get_category($category_id);
    if ($category->parent == 0) {
      return $category;
    }
  }
  return null;
}
function get_post_parent_categories($post_id) {
  $categories = wp_get_post_categories($post_id);
  $ret_categories = array();
  foreach ($categories as $category_id) {
    $category = get_category($category_id);
    if ($category->parent != 0) {
      $ret_categories[] = $category;
    }
  }
  return $ret_categories;
}

function insert_posts_list($atts) {
  $cat_name = $atts['cat_name'];
  $posts_per_page = (int)$posts_per_page = $atts['posts_per_page'] ?: get_option('posts_per_page');
  $actual_page = (int)$actual_page = get_query_var('ppno') ?: 1;
  if (empty($atts['pagination'])) {
    $atts['pagination'] = false;
  }
  $insert_pagination = $atts['pagination'];
  if (empty($atts['filter'])) {
    $atts['filter'] = 'latest';
  }
  $filter = get_query_var('filter') ?: $atts['filter'];
  if ($filter !== 'latest') {
    $cat_name = $filter;
  }
  $args = array('category_name' => $cat_name, 'pagination' => false, 'paged' => $actual_page, 'posts_per_page' => $posts_per_page,);
  $query = new WP_Query($args);

  $found_posts = (int)$query->found_posts;

  $post_fields = str_replace(' ', '', $atts['fields']);
  $arr_post_fields = explode(',', $post_fields);

  $ret = '<ul class="items clearfix">';
  while($query->have_posts()) {
    $query->the_post();
    $post_id = get_the_ID();
    if (!check_can_display($post_id)) {   // jeśli nie ma praw do wyświetlenia
      continue;
    }
    $post_url = get_permalink();
    $ret .= '<li class="span3">';
    foreach($arr_post_fields as $key => $val) {
      $field_content = get_field($val);
      if (empty($field_content) && ($val !== 'categories') && ($val !== 'title') && ($val !== 'content') && ($val !== 'teaser')) {
        continue;
      }
      $ret .= '<div class="' . $val . '">';
        switch ($val) {
          case 'categories': 
            $post_categories = get_post_parent_categories($post_id);
            $post_top_category = get_post_top_parent_category($post_id);
            $post_top_category_slug = $post_top_category->slug;
            foreach ($post_categories as $category) {
              $ret .= '<a href="/' . $post_top_category_slug . '/?filter=' . $category->slug . '" class="category">' . $category->name . '</a>, ';
            }
            $ret = trim($ret, ', ');
            break;
          case 'title' :
            $field_content = get_the_title();
            $ret .= '<h3><a href="' . $post_url . '">' . $field_content . '</a></h3>';
            break;
          case 'content' :
            $field_content = get_the_content();
            $ret .= $field_content;
            break;
          case 'teaser' :
            if (empty($field_content)) {
              $field_content = get_the_content();
            }
            $ret .= $field_content;
            break;
          case 'illustration' :
            $title = get_the_title();
            if (isset($atts['illustration_popup']) && ((bool)$atts['illustration_popup'] === true)) {
              $ret .= '<a href="' . $field_content . '" title="' . $title . '" class="no_hover zq_fancybox" rel="gallery_' . md5($cat_name) . '">';
            } else {
              $ret .= '<a href="' . $post_url . '" title="' . $title . '" class="no_hover">';
            }
            $ret .= '<img src="' . $field_content . '" alt="' . $title . '">';
            $ret .= '</a>';
            break;
          case 'illustration_big' :
            $title = get_the_title();
            if (isset($atts['illustration_popup']) && ((bool)$atts['illustration_popup'] === true)) {
              $ret .= '<a href="' . $field_content . '" title="' . $title . '" class="no_hover zq_fancybox" rel="gallery_' . md5($cat_name) . '">';
            } else {
              $ret .= '<a href="' . $post_url . '" title="' . $title . '" class="no_hover">';
            }
            $ret .= '<img src="' . $field_content . '" alt="' . $title . '">';
            $ret .= '</a>';
            break;
          case 'avatar' :
            $title = get_the_title();
            $ret .= '<a href="' . $post_url . '" title="' . $title . '" class="no_hover">';
            $ret .= '<img src="' . $field_content . '" alt="' . $title . '"></a>';
            break;
          case 'avatar_big' :
            $title = get_the_title();
            $ret .= '<a href="' . $post_url . '" title="' . $title . '" class="no_hover">';
            $ret .= '<img src="' . $field_content . '" alt="' . $title . '"></a>';
            break;
          default :
            $ret .= $field_content;
        }
      $ret .= '</div>';
    }
    $ret .= '</li>';
  }
  $ret .= '</ul>';
  if ($insert_pagination !== 'disabled' && $insert_pagination !== 'false'){ 
    $ret .= insert_pagination($found_posts, $posts_per_page, $actual_page);
  }
  return $ret;
}
add_shortcode('insert_posts_list', 'insert_posts_list');

function insert_full_width_slider($atts) {
  $cat_name = $atts['cat_name'];
  if (empty($atts['posts_per_page'])) {
    $atts['posts_per_page'] = get_option('posts_per_page');
  }
  $posts_per_page = (int)$posts_per_page = $atts['posts_per_page'];
  $args = array('category_name' => $cat_name, 'pagination' => false, 'posts_per_page' => $posts_per_page,);
  $query = new WP_Query($args);

  $ret = '<ul class="items">';
  while($query->have_posts()) :
    $query->the_post();
    $post_url = get_permalink();
    $title = get_the_title();
    $content = get_the_content();
    $ret .= '<li class="span9">';
    $ret .=   '<h3>' . $title . '<br><span>☐ ☐ ☐</span></h3>';
    $ret .=   '<div class="post_content">' . $content . '</div>';
    $ret .= '</li>';
  endwhile;
  $ret .= '</ul>';
  return $ret;
}
add_shortcode('insert_full_width_slider', 'insert_full_width_slider');

function get_attachement_item_html($obj) {
  if (empty($obj['url'])) {
    return '';
  }
  $title        = $obj['title'];
  $caption      = $obj['caption'];
  $description  = $obj['description'];
  $url          = $obj['url'];
  if (!$title) {
    $title = $url;
  }

  $ret  = '<li>';
  $ret .=   '<span class="caption">' . $caption . '</span>';
  $ret .=   '<a href="' . $url . '" class="title" title="' . $caption . '">' . $title . '</a>';
  $ret .=   '<p class="description">' . $description . '</p>';
  $ret .= '</li>';
  return $ret;
}

function insert_reader_profile($atts) {
  $post_id = get_the_ID();
  $title = get_the_title();
  $avatar = get_field('avatar', $post_id);
  $avatar_big = get_field('avatar_big', $post_id);
  $speciality = get_field('speciality', $post_id);
  $tutorials_info = get_field('tutorials_info', $post_id);
  $contact_info = get_field('contact_info', $post_id);
  $speciality_teaser = get_field('speciality_teaser', $post_id);
  $biography_info = get_field('biography_info', $post_id);
  $research_specializations = get_field('research_specializations', $post_id);
  $main_publications = get_field('main_publications', $post_id);
  $credits = get_field('credits', $post_id);
  $download_1  = get_field('download_1', $post_id);
  $download_2  = get_field('download_2', $post_id);
  $download_3  = get_field('download_3', $post_id);
  $download_4  = get_field('download_4', $post_id);
  $download_5  = get_field('download_5', $post_id);
  $download_6  = get_field('download_5', $post_id);
  $download_7  = get_field('download_7', $post_id);
  $download_8  = get_field('download_8', $post_id);
  $download_9  = get_field('download_9', $post_id);
  $download_10 = get_field('download_10', $post_id);
  $downloads_adv = get_field('downloads_adv', $post_id);


  $ret  = '<div class="clearfix">';
  $ret .=   '<img src="' . $avatar_big . '" alt="'. $title .'" class="span6 avatar">';
  $ret .=   '<div class="span3 info">';
  $ret .=     '<h5 class="name">' . $title . '</h5>';
  $ret .=     '<span class="speciality">' . $speciality . '</span>';
  $ret .=     '<div class="tutorials_info"><h6>Konsultacje:</h6>' . $tutorials_info . '</div>';
  $ret .=     '<span class="contact_info"><h6>Kontakt:</h6>' . $contact_info . '</span>';
  $ret .=   '</div>';
  $ret .= '</div>';
  $ret .= '<div class="spaciality_teaser"><p>' . $speciality_teaser . '</p></div>';

  $ret .= '<div class="accordion">';
    $ret .= '<h6>nota biograficzna</h6>';
    $ret .= '<div>' . $biography_info . '</div>';

    $ret .= '<h6>specjalizacje badawcze</h6>';
    $ret .= '<div>' . $research_specializations . '</div>';

    $ret .= '<h6>najważniejsze publikacje</h6>';
    $ret .= '<div>' . $main_publications . '</div>';

    $ret .= '<h6>stanowisko naukowe, członkostwa i wyróżnienia</h6>';
    $ret .= '<div>' . $credits . '</div>';

    $ret .= '<h6>pliki do pobrania</h6>';
    $ret .= '<div>';
      $ret .= '<ul class="files_list">';
      $ret .= get_attachement_item_html($download_1);
      $ret .= get_attachement_item_html($download_2);
      $ret .= get_attachement_item_html($download_3);
      $ret .= get_attachement_item_html($download_4);
      $ret .= get_attachement_item_html($download_5);
      $ret .= get_attachement_item_html($download_6);
      $ret .= get_attachement_item_html($download_7);
      $ret .= get_attachement_item_html($download_8);
      $ret .= get_attachement_item_html($download_9);
      $ret .= get_attachement_item_html($download_10);
      $ret .= '</ul>';
      $ret .= $downloads_adv;
    $ret .= '</div>';
  $ret .= '</div>';

  return $ret;
}
add_shortcode('insert_reader_profile', 'insert_reader_profile');

function insert_downloads($atts) {
  $reference_post_id = $atts['reference_post_id'];
  $reference_post = get_post($reference_post_id);
  $title = $reference_post->post_title;

  $download_1  = get_field('download_1', $reference_post_id);
  $download_2  = get_field('download_2', $reference_post_id);
  $download_3  = get_field('download_3', $reference_post_id);
  $download_4  = get_field('download_4', $reference_post_id);
  $download_5  = get_field('download_5', $reference_post_id);
  $download_6  = get_field('download_6', $reference_post_id);
  $download_7  = get_field('download_7', $reference_post_id);
  $download_8  = get_field('download_8', $reference_post_id);
  $download_9  = get_field('download_9', $reference_post_id);
  $download_10 = get_field('download_10', $reference_post_id);

  $downloads_adv = get_field('downloads_adv', $reference_post_id);

  $ret  = '<h2>pliki do pobrania / <a href="' . get_permalink($reference_post_id) . '">' . $title . '</a></h2>';
  $ret .= '<ul class="files_list">';
  $ret .= get_attachement_item_html($download_1);
  $ret .= get_attachement_item_html($download_2);
  $ret .= get_attachement_item_html($download_3);
  $ret .= get_attachement_item_html($download_4);
  $ret .= get_attachement_item_html($download_5);
  $ret .= get_attachement_item_html($download_6);
  $ret .= get_attachement_item_html($download_7);
  $ret .= get_attachement_item_html($download_8);
  $ret .= get_attachement_item_html($download_9);
  $ret .= get_attachement_item_html($download_10);
  $ret .= '</ul>';
  $ret .= $downloads_adv;

  return $ret;
}
add_shortcode('insert_downloads', 'insert_downloads');

function insert_effort_desc($atts) {
  $effort_desc = get_field('additional_description');
  return $effort_desc;
}
add_shortcode('insert_effort_desc', 'insert_effort_desc');

function insert_publication_illustration($atts) {
  $post_id = get_the_ID();
  $post = get_post($post_id);
  $title = $post->post_title;
  $photo_url = get_field('illustration', $post_id);
  $ret = '<img src="' . $photo_url . '" alt="ilustracja ' . $title . '">';
  return $ret;
}
add_shortcode('insert_publication_illustration', 'insert_publication_illustration');

function insert_publication_description($atts) {
  $post_id = get_the_ID();
  $info = get_field('additional_description', $post_id);
  $ret = $info;
  return $ret;
}
add_shortcode('insert_publication_description', 'insert_publication_description');

function insert_one_post_from_subcategories($atts) {
  $ret = '<h2>Prace<span class="subtitle">ostatnio dodane</span></h2>';
  $ret .= '<ul class="items clearfix">';

  $cat_name = $atts['cat_name'];
  $cat_id = get_cat_ID($cat_name);
  $sub_categories = get_categories(array('parent' => $cat_id));
  foreach ($sub_categories as $category) {
    $args = array('cat' => $category->cat_ID, 'posts_per_page' => 1);
    $query = new WP_Query($args);
    while($query->have_posts()) {
      $query->the_post();
      $post_id = get_the_ID();
      $post_url = get_permalink();
      $title = get_the_title();
      $photo_url = get_field('illustration', $post_id);
      $info = get_field('additional_description', $post_id);
      $post_categories = get_post_parent_categories($post_id);
      $ret .= '<li class="span3">';
      foreach ($post_categories as $category) {
        $ret .= '<a href="/prace/' . $category->slug . '" class="category">' . $category->name . '</a>';
      }
      $ret .= '<a href="' . $post_url . '" class="no_hover"><img src="' . $photo_url . '" alt=" ilustracja ' . $title . '"></a>';
      $ret .= '<h3><a href="' . $post_url . '">' . $title . '</a></h3>';
      $ret .=  $info;
      $ret .= '</li>';
    }
  }
  $ret .= '</ul>';
  return $ret;
}
add_shortcode('insert_one_post_from_subcategories', 'insert_one_post_from_subcategories');
