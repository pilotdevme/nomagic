<?php
	//require_once(TEMPLATEPATH . '/functions/admin-menu.php');//add theme options file
 	
	/* Add style sheets and js */
	function nomagic_wordpress_resources(){
		
		wp_enqueue_style('style',get_stylesheet_uri());
	}
	add_action('wp_enqueue_scripts','nomagic_wordpress_resources');
	
	//Theme Setup
	function nomagicwordpress_setup(){
		
		/* Add Navigation menu*/
		register_nav_menus( array(
		'primary' =>__('Primary Menu'),
		'footer' => __('Footer Menu'),
		) );
		
		//Adding diff layout for the wordpress posts 
	add_theme_support('post-formats', array('aside', 'gallery', 'link'));	
	
	// Add featured image support
	add_theme_support('post-thumbnails');
	}
	add_action('after_setup_theme','nomagicwordpress_setup');
	
	/* color selection from admin */
	function nomagic_customize_register($wp_customize){
		$wp_customize->add_setting('nomagic_link_color',array(
		'default'=>'#0063c3',
		'transport'=>'refresh',
		));
		$wp_customize->add_setting('nomagic_btn_color',array(
		'default'=>'#0063c3',
		'transport'=>'refresh',
		));
		$wp_customize->add_section('nomagic_standard_colors',array(
		'title'=>__('Standard Colors','nomagic'),
		'priority'=>30,
		));
		
		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize,'nomagic_link_color_control',array(
		'label'=>__('Link Color','nomagic'),
		'section'=>'nomagic_standard_colors',
		'settings'=>'nomagic_link_color',
		)));
		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize,'nomagic_btn_color_control',array(
		'label'=>__('Button Color','nomagic'),
		'section'=>'nomagic_standard_colors',
		'settings'=>'nomagic_btn_color',
		)));
	}
	add_action('customize_register','nomagic_customize_register');
	
	//output customize CSS
	
	function nomagic_wordpress_customize_css(){?>
	<style type="text/css">
		a:link,
		a:visited{
		color:<?php echo get_theme_mod('nomagic_link_color')?>;
		}
		.btn-a,
		.btn-a:link,
		.btn-a:visited{
		background-color:<?php echo get_theme_mod('nomagic_btn_color')?>;
		}
	</style>
	
	<?php }
	add_action('wp_head','nomagic_wordpress_customize_css');
	
	//Add widget section
	function nomagicwidgetInit(){
		
		register_sidebar(array(
		'name'=>'Sidebar',
		'id'=>'sidebar1',
		'before_widget'=>'<div class="widget-item">',
		'after_widget'=>'</div>'
		));
		register_sidebar(array(
		'name'=>'Footer Area 1',
		'id'=>'footer1'
		));
		register_sidebar(array(
		'name'=>'Footer Area 2',
		'id'=>'footer2'
		));
		register_sidebar(array(
		'name'=>'Footer Area 3',
		'id'=>'footer3'
		));
		register_sidebar(array(
		'name'=>'Footer Area 4',
		'id'=>'footer4'
		));
	}
	add_action('widgets_init','nomagicwidgetInit');
	
	// Customize excerpt word count length
	function custom_excerpt_length() {
		return 22;
	}
	
	add_filter('excerpt_length', 'custom_excerpt_length');
function add_theme_menu_item()
{
    add_menu_page("Theme Panel", "Theme Panel", "manage_options", "theme-panel", "theme_settings_page", null, 99);
}
 
add_action("admin_menu", "add_theme_menu_item");


function theme_settings_page(){
	?>
        <div class="wrap">
        <h1>Theme Panel</h1>
        <form method="post" action="options.php">
            <?php
			/* option group is "section" 
			Output nonce, action, and option_page fields for a settings page.
			Please note that this function must be called inside of the form tag for the options page
			*/
                settings_fields("section"); 
				
			/*Prints out all settings sections added to a particular settings page. 
				Parameters $page(string) (required) The slug name of the page whose settings sections you want to output.
				This should match the page name used in add_settings_section().
				*/
			
                do_settings_sections("theme-options");      
                submit_button(); 
            ?>          
			<?php 
			global $options;
			
			$options = get_option( 'sample_theme_options' );
				
				?> 
        </form>
        </div>
		 <?php
	}
 
 
function display_theme_panel_fields()
{
    add_settings_section("section", "All Settings", null, "theme-options");
     
    add_settings_field("twitter_url", "Twitter Profile Url", "display_twitter_element", "theme-options", "section");
    add_settings_field("facebook_url", "Facebook Profile Url", "display_facebook_element", "theme-options", "section");
	add_settings_field("youtube_url", "Youtube Profile Url", "display_youtube_element", "theme-options", "section");
	
	register_setting( "section", 'sample_theme_options');
	
}
 
add_action("admin_init", "display_theme_panel_fields");


function display_mybook_element()
{	
	
    ?>
        <input type="text" name="sample_theme_options[mybook_url]" id="sample_theme_options[mybook_url]" value="<?php  $options = get_option( 'sample_theme_options' ); echo $options['mybook_url']; ?>" />
    <?php
}

function display_twitter_element()
{
    ?>
        <input type="text" name="sample_theme_options[twitter_url]" id="sample_theme_options[twitter_url]" value="<?php  $options = get_option( 'sample_theme_options' ); echo $options['twitter_url']; ?>" />
    <?php
}
 
function display_facebook_element()
{
    ?>
        <input type="text" name="sample_theme_options[facebook_url]" id="sample_theme_options[facebook_url]" value="<?php  $options = get_option( 'sample_theme_options' ); echo $options['facebook_url']; ?>" />
    <?php
}
function display_youtube_element()
{
    ?>
       <input type="text" name="sample_theme_options[youtube_url]" id="sample_theme_options[youtube_url]" value="<?php  $options = get_option( 'sample_theme_options' ); echo $options['youtube_url']; ?>" />
    <?php
}
?>

