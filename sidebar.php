<?php
/**
 * The Template for the sidebar containing the main widget area
 *
 * @package  WordPress
 * @subpackage  Timber
 */
$context = array();
Timber::render('sidebar.twig', $context);
echo $context;