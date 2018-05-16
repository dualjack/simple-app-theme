<?php
get_header();
get_template_part( 'parts/header' );

$message =  apply_filters( 'the_content', '404' );
echo        apply_filters( 'front_404_message', $message );

get_template_part( 'parts/footer' );
get_footer();