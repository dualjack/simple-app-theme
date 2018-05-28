<?php
get_header();
get_template_part( 'parts/header' );

echo apply_filters( 'front_before_loop', '' );

if( have_posts() && apply_filters( 'front_display_posts', true ) ){

	while( have_posts() ){

		the_post();
		get_template_part( 'parts/content' );

	}

} else {

	echo apply_filters( 'front_no_posts', '' );

}

echo apply_filters( 'front_after_loop', '' );

get_template_part( 'parts/footer' );
get_footer();