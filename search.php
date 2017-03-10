<?php

get_header();?>

<div class="site-content clearfix">
    <div class="main-column">
        
        <?php

if(have_posts()):   ?>

    <h2>Search results for: <?php the_search_query(); ?></h2>

    <?php

    while(have_posts()) : the_post(); 
  
    get_template_part('content', get_post_format());

    endwhile;

    else :
        echo '<p>No content found</p>';

    endif;
        
        ?>
        
    </div>

    <?php get_sidebar(); ?>
    
</div>
<?php

get_footer();

?>