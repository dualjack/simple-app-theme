<?php
get_header();
get_template_part( 'parts/header' );

while( have_posts() ){

	the_post();

	echo '<article>';
	get_template_part( 'parts/content' );
	echo '</article>';

}

get_template_part( 'parts/footer' );
get_footer();