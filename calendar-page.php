<?php
/**
 * Template Name: Calendar Page
 * 
 * Description: A Page Template with a darker design.
 * 
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
 
$context = Timber::context();
$timber_post = Timber::query_post();
$context['post'] = $timber_post;
$context['footer_widget_1'] = Timber::get_widgets('footer_widget_1');
$context['footer_widget_2'] = Timber::get_widgets('footer_widget_2');
$context['footer_widget_3'] = Timber::get_widgets('footer_widget_3');
$monday = array(
    'post_type' => 'support-group',
    'tag' => 'monday',
    'orderby'   => 'title',
    'order' => 'ASC'
);
$context['monday'] = Timber::get_posts( $monday );
$tuesday = array(
    'post_type' => 'support-group',
    'tag' => 'tuesday',
    'orderby'   => 'title',
    'order' => 'ASC'
);
$context['tuesday'] = Timber::get_posts( $tuesday );
$wednesday = array(
    'post_type' => 'support-group',
    'tag' => 'wednesday',
    'orderby'   => 'title',
    'order' => 'ASC'
);
$context['wednesday'] = Timber::get_posts( $wednesday );
$thursday = array(
    'post_type' => 'support-group',
    'tag' => 'thursday',
    'orderby'   => 'title',
    'order' => 'ASC'
);
$context['thursday'] = Timber::get_posts( $thursday );
$friday = array(
    'post_type' => 'support-group',
    'tag' => 'friday',
    'orderby'   => 'title',
    'order' => 'ASC'
);
$context['friday'] = Timber::get_posts( $friday );
$saturday = array(
    'post_type' => 'support-group',
    'tag' => 'saturday',
    'orderby'   => 'title',
    'order' => 'ASC'
);
$context['saturday'] = Timber::get_posts( $saturday );
$templates = array( 'calendar-page.twig' );
if ( is_home() ) {
	array_unshift( $templates, 'front-page.twig', 'home.twig' );
}
Timber::render( $templates, $context );