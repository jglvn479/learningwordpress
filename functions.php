<?php 

function learningWordPress_resources(){
    
    wp_enqueue_style('style', get_stylesheet_uri());
    
}

add_action('wp_enqueue_scripts', 'learningWordPress_resources');





// Get top ancestor
function get_top_ancestor_id() {
    
    global $post;
    
    if ($post->post_parent) {
       $ancestors = array_reverse(get_post_ancestors($post->ID));
        return $ancestors[0];
        
    }
    
    return $post->ID;
    
}

// Does page have children?
function has_children() {
    
    global $post;
    
    $pages = get_pages( 'child_of=' .$post->ID );
    return count($pages);
    
}

// Customize excerpt word count length
function custom_excerpt_length() {
    return 25;
}

add_filter('excerpt_length', 'custom_excerpt_length');



function learningWordPress_setup() {
    
    // Navigation Menus
    register_nav_menus(array(
    'primary' => __( 'Primary Menu' ),
    'footer' =>  __( 'Footer Menu' ),
));
    
    // Add featured Image support
    add_theme_support('post-thumbnails');
    add_image_size('xsmall-thumbnail', 100, 60, true);
    add_image_size('small-thumbnail', 180, 120, true);
    add_image_size('banner-image', 920, 210, array('center', 'left'));
    
    // Add post format support
    add_theme_support('post-formats', array('aside', 'gallery', 'link'));
    
}

add_action('after_setup_theme', 'learningWordPress_setup');

// Add our Widget locations
function ourWidgetsInit() {
    
     register_sidebar( array(
        'name' => 'Sidebar 1',
        'id' => 'sidebar1',
        'before_widget' => '<div class="widget-side">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    
     register_sidebar( array(
        'name' => 'Sidebar 2',
        'id' => 'sidebar2',
        'before_widget' => '<div class="widget-side">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    
     register_sidebar( array(
        'name' => 'Sidebar 3',
        'id' => 'sidebar3',
        'before_widget' => '<div class="widget-side">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    
    register_sidebar( array(
        'name' => 'Footer Area 1',
        'id' => 'footer1',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    
    register_sidebar( array(
        'name' => 'Footer Area 2',
        'id' => 'footer2',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    
    register_sidebar( array(
        'name' => 'Footer Area 3',
        'id' => 'footer3',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    
    register_sidebar( array(
        'name' => 'Footer Area 4',
        'id' => 'footer4',
        'before_widget' => '<div class="widget-item">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    
}

add_action('widgets_init', 'ourWidgetsInit');

//Customize Appearance Options
function lwp_customize_register($wp_customize) {
    
    $wp_customize->add_section('lwp_standard_colors', array(
        'title' => __('Standard Colors', 'learningwordpress'),
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('lwp_link_color', array(
        'default' => '#006ec3',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_setting('lwp_btn_color', array(
        'default' => '#006ec3',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_setting('lwp_hover_color', array(
        'default' => '#006ec3',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'lwp_link_color_control', array(
        'label' => __('Link Color', 'LearningWordPress'),
        'section' => 'lwp_standard_colors',
        'settings' => 'lwp_link_color',
    ) ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'lwp_btn_color_control', array(
        'label' => __('Button Color', 'LearningWordPress'),
        'section' => 'lwp_standard_colors',
        'settings' => 'lwp_btn_color',
    ) ));
    
     $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'lwp_hover_color_control', array(
        'label' => __('Hover Color', 'LearningWordPress'),
        'section' => 'lwp_standard_colors',
        'settings' => 'lwp_hover_color',
    ) ));
    
}

add_action('customize_register', lwp_customize_register);


// Output Customize CSS
function lwp_customize_css() { ?>
    <style type="text/css">
        a:link,
        a:visited {
            
            color: <?php echo get_theme_mod('lwp_link_color'); ?>
        }
        
        .site-header nav ul li.current-menu-item a:link,
        .site-header nav ul li.current-menu-item a:visited,
        .site-header nav ul li.current-page-ancestor a:link,
        .site-header nav ul li.current-page-ancestor a:visited {
            
            background-color: <?php echo get_theme_mod('lwp_link_color'); ?>
        }
        
        .post-btn a:link,
        .post-btn a:visited,
        #searchsubmit{
            color: #fff;
            background-color: <?php echo get_theme_mod('lwp_btn_color'); ?>
        }
        
        .post-btn a:hover,
        #searchsubmit:hover {
            background-color: <?php echo get_theme_mod('lwp_hover_color'); ?>
        }
        
    </style>
<?php }

add_action('wp_head', 'lwp_customize_css');


// Add Footer Callout Section to admin Appearance customize screen
function lwp_footer_callout($wp_customize) {
    
    $wp_customize->add_section('lwp_footer_callout_section', array(
        'title' => __('Footer Callout', 'learningwordpress')
    ));
    
     $wp_customize->add_setting('lwp_footer_callout_display', array(
        'default' => 'No'
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'lwp_footer_callout_display_control', array(
        'label' => 'Display this section?',
        'section' => 'lwp_footer_callout_section',
        'settings' => 'lwp_footer_callout_display',
        'type' => 'select',
        'choices' => array('No' => 'No', 'Yes' => 'Yes')
    )));
    
    
    $wp_customize->add_setting('lwp_footer_callout_headline', array(
        'default' => 'Example Headline Text!'
    ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'lwp_footer_callout_headline_control', array(
        'label' => 'Headline',
        'section' => 'lwp_footer_callout_section',
        'settings' => 'lwp_footer_callout_headline'
    )));
    
     $wp_customize->add_setting('lwp_footer_callout_text', array(
        'default' => 'Example paragraph Text'
     ));
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'lwp_footer_callout_text_control', array(
        'label' => 'Text',
        'section' => 'lwp_footer_callout_section',
        'settings' => 'lwp_footer_callout_text',
        'type' => 'textarea'
    )));
    
    
     $wp_customize->add_setting('lwp_footer_callout_link');
    
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'lwp_footer_callout_link_control', array(
        'label' => 'Link',
        'section' => 'lwp_footer_callout_section',
        'settings' => 'lwp_footer_callout_link',
        'type' => 'dropdown-pages'
    )));
    
    $wp_customize->add_setting('lwp_footer_callout_image');
    
    $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'lwp_footer_callout_image_control', array(
        'label' => 'Image',
        'section' => 'lwp_footer_callout_section',
        'settings' => 'lwp_footer_callout_image',
        'width' => 750,
        'height' => 500
    )));
    
    

}

add_action('customize_register', 'lwp_footer_callout');
    

?>
