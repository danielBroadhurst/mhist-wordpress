<?php
/**
 * Template Name: Category Landing Page
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
$args2 = array(
    'post_type' => 'post',
    'category_name' => 'your_stories',
    'orderby'   => 'rand'
);
$context['your_stories'] = Timber::get_posts( $args2 );
$args2 = array(
    'post_type' => 'post',
    'category_name' => 'latest-news'
);
$context['news_stories'] = Timber::get_posts( $args2 );
$templates = array( 'category-landing-page.twig' );
if ( is_home() ) {
	array_unshift( $templates, 'front-page.twig', 'home.twig' );
}
Timber::render( $templates, $context );