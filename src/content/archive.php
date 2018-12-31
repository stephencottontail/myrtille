<?php
add_action( 'genesis_loop', 'myrtille_maybe_do_custom_loop', 5 );
function myrtille_maybe_do_custom_loop() {
	if ( ! is_singular() ) {
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'myrtille_archive_loop' );
	}
}

function myrtille_archive_loop() {

	/* there's got to be a better way to do this */
	remove_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
	remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
	remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
	remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
	remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );
	remove_action( 'genesis_entry_content', 'genesis_do_post_permalink', 14 );
	remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
	remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
	remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

	$posts_output = '';

	if ( have_posts() ) {

		do_action( 'genesis_before_while' );

		while ( have_posts() ) {

			the_post();

			$posts_output .= myrtille_archive_post_info();

		}

		genesis_markup( array(
			'open'    => '<p %s>',
			'close'   => '</p>',
			'context' => 'entry-container',
			'content' => $posts_output,
			'echo'    => true
		) );

		do_action( 'genesis_after_endwhile' );

	} else {

		do_action( 'genesis_loop_else' );

	}

	// reset everything
	genesis_reset_loops();
	add_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );
	add_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
	add_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
	add_action( 'genesis_entry_header', 'genesis_do_post_title' );
	add_action( 'genesis_entry_header', 'genesis_post_info', 12 );
	add_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
	add_action( 'genesis_entry_content', 'genesis_do_post_content' );
	add_action( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );
	add_action( 'genesis_entry_content', 'genesis_do_post_permalink', 14 );
	add_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
	add_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
	add_action( 'genesis_entry_footer', 'genesis_post_meta' );
}

function myrtille_archive_post_info() {
	$output = '';

	$title = get_the_title();
	$date = get_the_date();

	if ( $title ) {
		$title = genesis_markup( array(
			'open'    => '<a %s>',
			'close'   => '</a>',
			'content' => $title,
			'context' => 'entry-title-link',
			'echo'    => false
		) );
	} else {
		$date = genesis_markup( array(
			'open'    => '<a %s>',
			'close'   => '</a>',
			'content' => $date,
			'context' => 'entry-title-link',
			'echo'    => false
		) );
	}

	$output .= genesis_markup( array(
		'open'    => '<span %s>',
		'close'   => '</span>',
		'content' => $title,
		'context' => 'entry-title',
		'echo'    => false
	) );

	$output .= genesis_markup( array(
		'open'    => '<span %s>',
		'close'   => '</span>',
		'content' => $date,
		'context' => 'entry-date',
		'echo'    => false
	) );

	return $output;
}

add_action( 'genesis_attr_entry-container', 'myrtille_set_entry_container_atts' );
function myrtille_set_entry_container_atts( $attributes ) {
	$attributes['class'] = "$attributes[class] m-0";

	return $attributes;
}

add_action( 'genesis_attr_entry-title-link', 'myrtille_set_entry_link_atts' );
function myrtille_set_entry_link_atts( $attributes ) {
	if ( is_singular() ) {
		return;
	}

	$attributes['class'] = "$attributes[class] text-2xl";

	return $attributes;
}
