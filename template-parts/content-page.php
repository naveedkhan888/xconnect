<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package xConnect
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="inner-post">
	    <?php
	    
	    the_content();

	    wp_link_pages( array(
	        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'xconnect' ),
	        'after'  => '</div>',
	    ) );
	    ?>
	</div>
</article>