<?php
add_action( 'genesis_attr_site-header', function( $attributes ) {
	$attributes['class'] = "$attributes[class] text-center text-milk-darkest";

	return $attributes;
} );

add_action( 'genesis_attr_site-title', function( $attributes ) {
	$attributes['class'] = "$attributes[class] text-3xl lg:text-4xl leading-none";

	return $attributes;
} );

add_action( 'genesis_attr_site-description', function( $attributes ) {
	$attributes['class'] = "$attributes[class] leading-none";

	return $attributes;
} );

