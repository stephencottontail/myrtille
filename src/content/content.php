<?php
add_action( 'genesis_entry_header', function() {

	/** There is no reason to do this **/
	$img = genesis_get_image( array(
		'format'  => 'html',
		'size'    => 'full',
		'context' => 'single',
		'attr'    => genesis_parse_attr( 'entry-image', array() )
	) );

	if ( ! empty( $img ) ) {
		genesis_markup( array(
			'open'   => '<div %s>',
			'close'  => '</div>',
			'content' => $img,
			'context' => 'entry-thumbnail',
		) );
	}
}, 8 );

remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', function() {
	$output = '';

	$title = get_the_title();
	$date = get_the_date();

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

	echo $output;
}, 12 );

add_action( 'genesis_attr_entry-title', function( $attributes ) {
	$attributes['class'] = "$attributes[class] text-2xl";

	return $attributes;
} );

add_action( 'genesis_attr_entry-date', function( $attributes ) {
	$attributes['class'] = "$attributes[class] text-black-light";

	return $attributes;
} );

add_action( 'genesis_attr_entry-content', function( $attributes ) {
	$attributes['class'] = "$attributes[class] my-8";

	return $attributes;
} );

remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
add_action( 'genesis_entry_footer', function() {
	$output = '';

	$cats = get_the_category_list( esc_html_x( ', ', 'list item separator', 'myrtille' ) );
	if ( $cats ) {
		$cats = genesis_markup( array(
			'open'   => '<span %s>',
			'close'  => '</span>',
			'content' => $cats,
			'context' => 'entry-meta',
			'echo'   => false
		) );
	}

	$tags = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'myrtille' ) );
	if ( $tags ) {
		$tags = genesis_markup( array(
			'open'   => '<span %s>',
			'close'  => '</span>',
			'content' => $tags,
			'context' => 'entry-meta',
			'echo'   => false
		) );
	}

	printf( '%s%s%s%s',
		genesis_markup( array(
			'open'    => '<span %s>',
			'close'   => '</span>',
			'content' => esc_html__( 'Categories', 'myrtille' ),
			'context' => 'entry-meta-title',
			'echo'    => false
		) ),
		$cats,
		genesis_markup( array(
			'open'    => '<span %s>',
			'close'   => '</span>',
			'content' => esc_html__( 'Tags', 'myrtille' ),
			'context' => 'entry-meta-title',
			'echo'    => false
		) ),
		$tags
	);
} );

add_filter( 'genesis_attr_entry-meta-title', function( $attributes ) {
	$attributes['class'] = "$attributes[class] text-2xl";

	return $attributes;
} );

add_filter( 'genesis_attr_entry-meta', function( $attributes ) {
	$attributes['class'] = "$attributes[class] text-black-light";

	return $attributes;
} );
