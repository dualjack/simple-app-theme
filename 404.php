<?php
get_header();
get_template_part( 'parts/header' );

echo apply_filters( 'front_404_message', sprintf( '<p>%1$s</p>', __( '404 - Not Found' ) ) );

get_template_part( 'parts/footer' );
get_footer();