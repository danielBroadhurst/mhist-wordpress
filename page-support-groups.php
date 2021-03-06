<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/views/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();
$context['posts'] = Timber::get_posts();

$args = array(
    'post_type' => 'support-group',
    'orderby'   => 'title',
    'order' => 'ASC',
    'numberposts'      => -1,
);
$context['support_groups'] = Timber::get_posts( $args );
$args6 = array(
    'post_type' => 'supporters',
    'orderby'     => 'rand'
);
$context['supporters'] = Timber::get_posts( $args6 );
$context['home_page_sponsors'] = Timber::get_widgets('home_page_sponsors');
$context['footer_widget_1'] = Timber::get_widgets('footer_widget_1');
$context['footer_widget_2'] = Timber::get_widgets('footer_widget_2');
$context['footer_widget_3'] = Timber::get_widgets('footer_widget_3');
$timber_post = new Timber\Post();
$context['post'] = $timber_post;
Timber::render( array( 'page-support-groups.twig', 'page.twig' ), $context );
