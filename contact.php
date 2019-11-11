<?php
/**
* Plugin Name: Contact Form
* Plugin URI: https://www.domain.com/
* Description: Contact form in post or page using ajax form using short code.
* Version: 1.0
* Author: Auhor 
* Author URI: http://domain.com/
**/


define( 'CONTACT234_PLUGIN', __FILE__ );

define( 'CONTACT234_PLUGIN_BASENAME', plugin_basename( CONTACT234_PLUGIN ) );

define( 'CONTACT234_PLUGIN_NAME', trim( dirname( CONTACT234_PLUGIN_BASENAME ), '/' ) );

define( 'CONTACT234_PLUGIN_DIR', untrailingslashit( dirname( CONTACT234_PLUGIN ) ) );
define( 'CONTACT234_PLUGIN_PATH', plugin_dir_url( CONTACT234_PLUGIN_BASENAME ));

function installer(){
    include(CONTACT234_PLUGIN_PATH.'admin/installer.php');
}
register_activation_hook( __file__, 'installer' );

function contact234_wordpress_plugin_contact($atts) {
	?>
	<form>
	<div class="inputWithIcon">
	<input type="text" name="name" placeholder="Full Name">
	<i class="fa fa-user " aria-hidden="true"></i>
	</div>

	<div class="inputWithIcon">
	<input type="text" name="email" placeholder="Email">
	<i class="fa fa-envelope " aria-hidden="true"></i>
	</div>

	<div class="inputWithIcon">
	<input type="text" name="phone" placeholder="Phone Number">
	<i class="fa fa-mobile fa-lg fa-fw" aria-hidden="true"></i>
	</div>

	<div class="inputWithIcon">
	<textarea type="text" name="message" placeholder=""> Question/Comments</textarea>
	<i class="fa fa-comments-o fa-lg fa-fw" aria-hidden="true"></i>
	</div>

	<button type="submit" name="submit_contact" class="btn sub_button" id="js-contact-btn">Contact Us</button>
	</div>
	</form>
 	<?php
}

add_shortcode('contact234', 'contact234_wordpress_plugin_contact');


require CONTACT234_PLUGIN_DIR . '/admin/admin-functions.php';



function contact_form_scritp()
{
	wp_enqueue_style( 'my-child-fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'contact-us',CONTACT234_PLUGIN_PATH.'css/custom.css' );

    wp_enqueue_script('custom.js', CONTACT234_PLUGIN_PATH.'js/custom.js', array('jquery'), '20190207', true);
	
    wp_localize_script( 'ajax-script', 'contact234',array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action('wp_enqueue_scripts', 'contact_form_scritp');
add_action('admin_enqueue_scripts', 'contact_form_scritp');


function insert_contact_message(){
	if ( isset( $_POST['gg'] ) ) {
        $post = array(
            'post_content' => $_POST['content'], 
            'post_title'   => $_POST['title']
        );
        $id = wp_insert_post( $post, $wp_error );
    }
	$result = array('status'=>'success','message'=>'Thank you for contacting us!');
	$result1 = json_decode($result);
	print_r($result1);
	exit;
}

add_action('wp_ajax_insert_contact_message', 'insert_contact_message');
add_action('wp_ajax_nopriv_insert_contact_message', 'insert_contact_message');