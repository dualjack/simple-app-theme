<?php

echo apply_filters( 'front_post_before', '' );

printf( '<div %1$s>', get_post_class() );

echo apply_filters( 'front_post_title', sprintf( '<h1>%1$s</h1>', get_the_title() ) );
echo apply_filters( 'front_post_content', sprintf( '<article>%1$s</article>', get_the_content() ) );

printf( '</div>' );

echo apply_filters( 'front_post_after', '' );

?>