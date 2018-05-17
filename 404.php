<?php
get_header();
get_template_part( 'parts/header' );

echo apply_filters( 'front_404_before', '' );

$message =  apply_filters( 'the_content', '404' );
echo        apply_filters( 'front_404_message', $message );

echo apply_filters( 'front_404_after', '' );

get_template_part( 'parts/footer' );
get_footer();