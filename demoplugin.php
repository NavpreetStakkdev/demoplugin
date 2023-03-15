<?php
/*
 * Plugin Name:       Plugin Demo
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Navpreet
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       wpplugin
 * Domain Path:       /languages
 */

define('DEMOPLUGIN_DIRPATH',plugin_dir_path( __FILE__ ));
define( 'WPPLUGIN_URL', plugin_dir_url( __FILE__ ) );
add_action('admin_menu','wpplugin_menu_page');
function wpplugin_menu_page(){
    add_menu_page(
        'demoplugin page',
        'demoplugin menu',
        'manage_options',
        'wpplugin',
        'demoplugin_page_maker',
        'dashicons-microphone',
        100
    );
}
function demoplugin_page_maker(){
    ?>
    <div class="wrap">
        <form method="post" action="options.php">
            <?php settings_fields('wpplugin_form'); ?>
            <?php do_settings_sections('wpplugin'); ?>
            <?php do_settings_fields('wpplugin','wpplugin-section'); ?> 
            <?php submit_button(); ?>
        </form>
    </div>

   <?php
   demoplugin_simple_page_maker();
}
function demoplugin_simple_page_maker(){
    ?>
    <h1>Manual form :</h1>
      <div class="wpplugin_manual">
        <form method="post" action="admin.php?page=wpplugin">
        <label for="name">Name:</label>
        <input type="text" name="name"><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email"><br><br>
        <label for="location">Location:</label>
        <input type="text" name="location"><br><br>
         <input id="submit" type="submit" value="Submit">
        </form>
    </div>
    <?php

}


add_action('admin_enqueue_scripts','wpplugin_admin_extrascripts_adder');
function wpplugin_admin_extrascripts_adder($hook){
    if('toplevel_page_wpplugin'==$hook){
    wp_enqueue_style(
        'wpplugin-admin',
        WPPLUGIN_URL.'admin/css/wpplugin-admin-style.css',
        [],
        time()
    );
//     // wp_enqueue_script(
//     //     'wpplugin-admin',
//     //     WPPLUGIN_URL.'admin/js/wpplugin-admin-script.js',
//     //     [],
//     //     time()
//     // );
}
 }



 add_filter('plugin_action_links_'.plugin_basename( __FILE__ ),'wpplugin_link_adder');
 function  wpplugin_link_adder($links){
    $newlink='<a href="admin.php?page=wpplugin">menu</a>';
    array_push($links,$newlink);
    return $links;
 }



 add_action('admin_init','wpplugin_page_registerer');
 function wpplugin_page_registerer(){
   register_setting('wpplugin_form','wpplugin_form');
   add_settings_section('wpplugin-section','Current User Details','wpplugin_section_descriptor','wpplugin');
   add_settings_field('wpplugin-form-name','Name','name_input','wpplugin','wpplugin-section');
   add_settings_field('wpplugin-form-email','Email','email_input','wpplugin','wpplugin-section');
   add_settings_field('wpplugin-form-location','Location','location_input','wpplugin','wpplugin-section');
   register_setting('wpplugin_form','wpplugin_form');

 }
 function wpplugin_section_descriptor(){
    $name="";
    $email="";
    $location="";
    $option=get_option('wpplugin_form');
    if(isset($option['name'])){
        $name=$option['name'];
    
    }
    if(isset($option['email'])){
        $email=$option['email'];
    
    }
    if(isset($option['location'])){
        $location=$option['location'];
    
    }

    echo 'name:  '. $name.'<br>';
    echo 'email:  '. $email.'<br>';
    echo 'location:  '. $location.'<br>';
    echo "<h3>Switch to another user</h3>";
    echo '<h1 id="wpplugin_sett">Settings Api form :</h1>';
 }
 function name_input(){
    $prevname="";
    $option=get_option('wpplugin_form');
    if(isset($option['name'])){
        $prevname=$option['name'];
    
    }
    echo '<input type="text" id="wpplugin_name" name="wpplugin_form[name]" value="'.$prevname.'"/>';
}
function email_input(){
    $prevname="";
    $option=get_option('wpplugin_form');
    if(isset($option['email'])){
        $prevname=$option['email'];
    
    }
    echo '<input type="email" id="wpplugin_email" name="wpplugin_form[email]" value="'.$prevname.'"/>';
  
}
function location_input(){
    $prevname="";
    $option=get_option('wpplugin_form');
    if(isset($option['location'])){
        $prevname=$option['location'];
    
    }
    echo '<input type="text" id="wpplugin_location" name="wpplugin_form[location]" value="'.$prevname.'"/>';
    
}
