<?php

/* *********************** Admin Contact Template ********************* */
function contact234_admin_menu()
{
	$icon_url = get_bloginfo('template_url')."/pkb-options/images/setting-admin.png";	
	add_menu_page('Contact Message', 'Contact ', 'manage_options', 'contacts',  'contact234_option', 'dashicons-email-alt');
    add_submenu_page('contacts', 'Add New', 'Form/Shortcode', 'manage_options', 'contacts-add', 'contactform');
    add_submenu_page('contacts', 'View Message', '', 'manage_options', 'contacts-message', 'messageview');
}

add_action('admin_menu', 'contact234_admin_menu');

function contact234_option()
{
	include_once(CONTACT234_PLUGIN_DIR .'/admin/contact_list.php');
}

function contactform()
{
    include_once(CONTACT234_PLUGIN_DIR .'/admin/contact_form.php');
}
function messageview()
{
    include_once(CONTACT234_PLUGIN_DIR .'/admin/contact_message.php');
}


function get_pkb_site_options($slug){
    global $wpdb;
    $text = '';
    $sql = "select * from ".$wpdb->prefix."site_pkb_options WHERE status = '1' AND " ;
    $sql .= 'slug ="'.$slug.'"';
    $sql .= " order by id ASC limit 1";	
    //echo $sql;
    $result = $wpdb->get_results($sql);
    if(isset($result) && count($result) > 0){
        $text =  stripslashes($result[0]->content);
    }
    return $text;
}