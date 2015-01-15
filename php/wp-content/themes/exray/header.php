<!DOCTYPE html>
<html <?php language_attributes(); ?> >
    <head>
        <meta name="wot-verification" content="48c04e99dc6a4dba8a96"/>
        <meta charset="<?php bloginfo('charset'); ?>">
        <title><?php wp_title('|', true, 'right'); ?></title>
        <meta name="author" content="" >

        <!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif] -->

        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <!-- Script required for extra functionality on the comment form -->
        <?php if (is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply'); ?>

        <?php wp_head(); ?>
    </head>
    <body <?php body_class() ?> >
        <?php 
            $options = get_option('exray_custom_settings'); 
            global $exray_general_options;
        ?>

        <!--[if lte IE 8 ]>
        <noscript>
                <strong>JavaScript is required for this website to be displayed correctly. Please enable JavaScript before continuing...</strong>
        </noscript>
        <![endif]-->

        <div id="page" class="wrap">

            <div class="header-container">

                <header class="top-header" id="top" role="banner">
                    <div class="container" id="header-wrap">

                        <div class="row">
                            <div class="logo-container"> 

                                <?php if ($options['display_logo'] != 0) : ?>

                                     <?php if (is_home()) : ?>

                                        <!-- Display logo Image -->
                                        <h1 class="logo"> 
                                            <a href="<?php echo esc_url(home_url()); ?>">
                                                <img src="<?php echo $options['exray_theme_logo']; ?>" alt="<?php bloginfo('name') ?> | <?php bloginfo('description') ?>">
                                            </a>
                                        </h1>

                                    <?php else: ?>

                                        <p class="logo"> 
                                            <a href="<?php echo esc_url(home_url()); ?>">
                                                <img src="<?php echo $options['exray_theme_logo']; ?>" alt="<?php bloginfo('name') ?> | <?php bloginfo('description') ?>">
                                            </a>
                                        </p>

                                    <?php endif; ?>

                                <?php else: ?>	

                                <?php if (is_home()) : ?>

                                        <!-- Display text logo and tagline	 -->
                                        <hgroup class="text-logo">
                                            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                                            <h2 class="site-description"><?php bloginfo('description'); ?></h2>
                                        </hgroup>

                                <?php else: ?>

                                        <!-- Display text logo and tagline	 -->
                                        <hgroup class="text-logo">
                                            <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                                            <p class="site-description"><?php bloginfo('description'); ?></p>
                                        </hgroup>

                                <?php endif; ?>

                        <?php endif; ?>					

                            </div>	
                            <!-- End span3 --> 	
                            <div class="clearfix">

                    <?php if ($options['display_top_ad'] && $options['top_ad'] != '') : ?>

                            <aside id="header-widget" class="right-header-widget fr top-widget" role="complementary">

                                <figure class="banner">
                                    <a href="<?php echo esc_url( $options['top_ad_link'] ); ?>"><img src="<?php echo esc_url( $options['top_ad'] ); ?>" class="centered" alt="Ad"></a>
                                </figure>

                            </aside>		
                            <!-- End Header Widget	 -->
                    <?php endif; ?>

                            </div>	
                            <!-- End Span9 -->						
                        </div> 	
                        <a href="http://www.swps.pl/wroclaw" id="swps_logo" class="no_hover"><img src="/wp-content/themes/exray/images/swps_logo.png" alt="SWPS logo"></a>
                        <!-- End row -->
                    </div>	
                    <!-- End container -->
                </header>	
                <!-- End top-main-header -->
            </div> 
            <!-- End header-container -->	
