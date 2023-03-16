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
    <div class="wrap demomain">
      <h1>Welcome to HTML-IMAGE to PDF converter</h1>
      <p>choose what you want to convert to pdf:</p><br>
      <a href="admin.php?page=wpplugin&ref=image">IMAGE</a>
      <a href="admin.php?page=wpplugin&ref=html">HTML</a>
      <br>
      <?php ; ?>

      <?php if(isset($_GET['ref'])){ ?>

     <?php if( $_GET['ref']=="html"){?>
      <form id="html" method="post" action="http://localhost/wordpress/wp-content/plugins/demoplugin/download.php">
        <h1>Paste your HTML code in the box:</h1>
        <input type="hidden" name="page" value="html">
        <h1>HTML code:</h1>
        <textarea name="html" placeholder="paste your html code here...." required></textarea><br>
        <input class="demomainsubmit" id="htmlsub" type="submit" value="Download">
     </form>
     <br>


     <?php }elseif( $_GET['ref']=="image"){ ?>
      <form id="image" method="post" action="http://localhost/wordpress/wp-content/plugins/demoplugin/download.php" enctype="multipart/form-data">
        <h1>Import your image:</h1>
        <input type="hidden" name="page" value="image">
        <label>Image file:</label>
        <input type="file"  id="htmlsub" name="image" required><br>
        <input class="demomainsubmit" id="imagesub"  type="submit" value="Download">
     </form>
     <?php } ?>

     <?php  }?>
       
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
}
 } 
           

 add_filter('plugin_action_links_'.plugin_basename( __FILE__ ),'wpplugin_link_adder');
 function  wpplugin_link_adder($links){
    $newlink='<a href="admin.php?page=wpplugin">menu</a>';
    array_push($links,$newlink);
    return $links;
 }




 // //     // wp_enqueue_script(
// //     //     'wpplugin-admin',
// //     //     WPPLUGIN_URL.'admin/js/wpplugin-admin-script.js',
// //     //     [],
// //     //     time()
// //     // );