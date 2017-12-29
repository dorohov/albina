<?php
/**
 * Template Name: Category
 */

$Azbn->entity = $Azbn->getEntity();

$b_tpl = 'price';

//if (have_posts()) {
	
	$_posts = array();
	
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			
			$_posts[] = get_post(get_the_ID());
			
		}
	}
	
	//var_dump($_posts);
	
	$Azbn->tpl('_/header', array());
	$Azbn->tpl($b_tpl.'/cat', array(
		'posts' => $_posts,
	));
	$Azbn->tpl('_/footer', array());
	
//}