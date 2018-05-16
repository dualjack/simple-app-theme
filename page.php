<?php
get_header();
get_template_part( 'parts/header' );

if( have_posts() ){

	while( have_posts() ){

		the_post();
		get_template_part( 'parts/content' );

	}

} else {

	echo apply_filters( 'front_no_posts', '' );

}

get_template_part( 'parts/footer' );
get_footer();