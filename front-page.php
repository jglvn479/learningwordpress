<?php

get_header(); ?>

<div class="site-content clearfix">
    
    <?php 
    
        if(have_posts()):
        while(have_posts()) : the_post(); 

            the_content();

        endwhile;

        else :

            echo '<p>No content found</p>';

        endif;  
    
    ?>
    
    <div class="home-columns clearfix">

        
        
    <div class="one-half"> <?php
        
        // Opinion posts loop begins here 

        $opinionPosts = new WP_Query('cat=4&posts_per_page=2'); ?>

            <h1>Latest Opinion</h1>
        <?php
            if($opinionPosts->have_posts()) :

                while ($opinionPosts->have_posts()) : 

                $opinionPosts->the_post(); ?>

                    <div class="one-half-content has-thumbnail-home">

                        <div class="home-thumbnail">

                            <a href="<?php the_permalink(); ?>"><?php if(!is_single()) {the_post_thumbnail('xsmall-thumbnail');} ?></a>

                        </div>

                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><span class="home-time"><?php the_time('F Y'); ?></span></h2>
                        
                        

                        <?php the_excerpt('Read more &raquo;'); 
                        
                       ?>
                        
                    </div>
        
                <?php endwhile;

            else :

            endif;
        
        wp_reset_postdata(); 
        
         $category_link = get_category_link(4); ?>
        
            <div class="post-btn">

                <a href="<?php echo esc_url($category_link); ?>">View all Opinion Posts</a>

            </div>
                        
        
    </div>
        
    <div class="one-half last"> <?php
        // News posts loop begins here 
        
        $newsPosts = new WP_Query('cat=5&posts_per_page=2&orderby=rand'); ?>
        
            <h1>Random News</h1>
            
            <?php
            if($newsPosts->have_posts()) :

                while ($newsPosts->have_posts()) : $newsPosts->the_post(); ?>

                    <div class="one-half-content last <?php if(has_post_thumbnail()) { ?> has-thumbnail-home <?php }?>">

                        <div class="home-thumbnail">

                            <a href="<?php the_permalink(); ?>"><?php if(!is_single()) {the_post_thumbnail('xsmall-thumbnail');}?></a>

                        </div>


                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><span class="home-time"><?php the_time('F Y'); ?></span></h2>

                        <?php the_excerpt('Read more &raquo;'); 
                        ?>
                
                    </div>
        
               

        wp_reset_postdata(); 
        
         $category_link = get_category_link(5); ?>
        
            <div class="post-btn">
                
                 <a href="<?php echo esc_url($category_link); ?>">View all News Posts</a>
                
            </div>
                       
        
    </div>
        

    </div> <!-- End of home-columns -->

</div> <!-- End of site-content -->

<?php

get_footer();

?>