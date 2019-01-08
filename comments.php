<?php
/**
 * I like that this is necessary
 */

if ( post_password_required() ) {
	printf( '<p class="m-0">%s</p>', esc_html__( 'Enter the password to view comments for this post.', 'myrtille' ) );
}

add_filter( 'genesis_comment_list_args', function( $defaults ) {
	$defaults['callback'] = 'myrtille_show_comments';

	return $defaults;
}, 15, 1 );

function myrtille_show_comments( $comment, array $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>

	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
	<article <?php echo genesis_attr( 'comment' ); ?>>
		<?php do_action( 'genesis_before_comment' ); ?>
		<header <?php echo genesis_attr( 'comment-header' ); ?>>
			<div <?php echo genesis_attr( 'comment-avatar' ); ?>>
				<?php
				if ( 0 !== $args['avatar_size'] ) {
					echo get_avatar( $comment, $args['avatar_size'] );
				}
				?>
			</div>
			<div <?php echo genesis_attr( 'comment-meta' ); ?>>
				<?php
				$url = get_comment_author_url();

				if ( ! empty( $url ) && 'http://' !== $url ) {
					printf( '<a href="%s" %s>%s</a>', esc_url( $url ), genesis_attr( 'comment-author' ), get_comment_author() );
				} else {
					genesis_markup( array(
						'open'  => '<span %s>',
						'close' => '</span>',
						'content' => get_comment_author(),
						'context' => 'comment-author',
						'echo'    => true
					) );
				}
				?>
				<span <?php echo genesis_attr( 'comment-date' ); ?>><?php echo get_comment_date(); ?></span>
			</div>
		</header>

		<div <?php echo genesis_attr( 'comment-content' ); ?>>
			<?php if ( 0 !== $comment->comment_parent ) : ?>
				<p class="font-mono m-0 lg:hidden"><?php printf( esc_html__( 'In reply to %s', 'myrtille' ), get_comment( $comment->comment_parent )->comment_author ); ?></p>
			<?php
			endif;

			if ( ! $comment->comment_approved ) : ?>
				<p class="font-mono m-0"><?php esc_html_e( 'Your comment is awaiting moderation.', 'myrtille' ); ?></p>
			<?php
			endif;

			comment_text();
			?>
		</div>

		<footer <?php echo genesis_attr( 'comment-footer' ); ?>>
			<?php
			comment_reply_link( array_merge( $args, array(
				'depth'  => $depth,
				'before' => sprintf( '<span %s>', genesis_attr( 'comment-reply-link' ) ),
				'after'  => '</span>'
			) ) );

			edit_comment_link( esc_html__( 'Edit', 'myrtille' ), sprintf( '<span %s>', genesis_attr( 'comment-edit-link' ) ), '</span>' );
			?>
		</footer>

		<?php do_action( 'genesis_after_comment' ); ?>
	</article>
<?php
}

add_action( 'genesis_attr_comment', function( $attributes ) {
	$attributes['class'] = "$attributes[class] mb-4";

	return $attributes;
} );

add_action( 'genesis_attr_comment-header', function( $attributes ) {
	$attributes['class'] = "$attributes[class] flex";

	return $attributes;
} );

add_action( 'genesis_attr_comment-avatar', function( $attributes ) {
	$attributes['class'] = "$attributes[class] mr-4";

	return $attributes;
} );

add_action( 'genesis_attr_comment-author', function( $attributes ) {
	$attributes['class'] = "$attributes[class] font-mono";

	return $attributes;
} );

add_action( 'genesis_attr_comment-date', function( $attributes ) {
	$attributes['class'] = "$attributes[class] block text-black-lighter";

	return $attributes;
} );

add_action( 'genesis_attr_comment-reply-link', function( $attributes ) {
	$attributes['class'] = "$attributes[class] inline-block mr-1";

	return $attributes;
} );

add_action( 'genesis_attr_comment-edit-link', function( $attributes ) {
	$attributes['class'] = "$attributes[class] inline-block mr-1";

	return $attributes;
} );

do_action( 'genesis_before_comments' );
do_action( 'genesis_comments' );
do_action( 'genesis_after_comments' );

do_action( 'genesis_before_pings' );
do_action( 'genesis_pings' );
do_action( 'genesis_after_pings' );

do_action( 'genesis_before_comment_form' );
do_action( 'genesis_comment_form' );
do_action( 'genesis_after_comment_form' );
