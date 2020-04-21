<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();
$context['footer_widget_1'] = Timber::get_widgets('footer_widget_1');
$context['footer_widget_2'] = Timber::get_widgets('footer_widget_2');
$context['footer_widget_3'] = Timber::get_widgets('footer_widget_3');
Timber::render( '404.twig', $context );
