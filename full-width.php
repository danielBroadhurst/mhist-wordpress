<?php
/**
 * Template Name: Full Width Page
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$context = Timber::context();
$timber_post = new Timber\Post();
$context['post'] = $timber_post;
$context['footer_widget_1'] = Timber::get_widgets('footer_widget_1');
$context['footer_widget_2'] = Timber::get_widgets('footer_widget_2');
$context['footer_widget_3'] = Timber::get_widgets('footer_widget_3');
$context['page_right'] = Timber::get_widgets('page_right');
$context['page_right_small'] = Timber::get_widgets('page_right_small');
$templates = array( 'full-width.twig' );
if ( is_home() ) {
	array_unshift( $templates, 'front-page.twig', 'home.twig' );
}
Timber::render( $templates, $context );
