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
    <div class="dhim">
        <h1><?php  esc_html_e(get_admin_page_title()); ?></h1>
        <p>this is page content.....</p>
        <?php
      $wpplugin_plugin_basename = plugin_basename( __FILE__ );
      $wpplugin_plugin_dir_path = plugin_dir_path( __FILE__ );
      $wpplugin_plugins_url_default = plugins_url();
      $wpplugin_plugins_url = plugins_url( 'includes', __FILE__ );
      $wpplugin_plugin_dir_url = plugin_dir_url( __FILE__ );
    ?>

    <ul>
      <li>plugin_basename( __FILE__ ) - <?php echo $wpplugin_plugin_basename; ?></li>
      <li>plugin_dir_path( __FILE__ ) - <?php echo $wpplugin_plugin_dir_path; ?></li>
      <li>plugins_url() - <?php echo $wpplugin_plugins_url_default; ?></li>
      <li>plugins_url( 'includes', __FILE__ ) - <?php echo $wpplugin_plugins_url; ?></li>
      <li>plugin_dir_url( __FILE__ ) - <?php echo $wpplugin_plugin_dir_url; ?></li>
      <li>define - <?php echo DEMOPLUGIN_DIRPATH ?></li>
    </ul>
    </div>
    <?php
    $string=get_option('wpplugin_option');
    echo $string;
    // $array=get_option('wpplugin_option');
    // $table='<table><tr><th>name</th><th>location</th></tr>';
    // foreach($array as $key => $value){
    //   $table.='<tr>
    //   <td>'.$key.'</td>
    //   <td>'.$value.'</td>
    // </tr>'
    // }
    // $table.='</table>';
    // echo $table;
}
add_action('admin_init','wpplugin_admin_extrascripts_adder');

add_action('admin_enqueue_scripts','wpplugin_admin_extrascripts_adder');
function wpplugin_admin_extrascripts_adder($hook){
    if('toplevel_page_wpplugin'==$hook){
    wp_enqueue_style(
        'wpplugin-admin',
        WPPLUGIN_URL.'admin/css/wpplugin-admin-style.css',
        [],
        time()
    );
    wp_enqueue_script(
        'wpplugin-admin',
        WPPLUGIN_URL.'admin/js/wpplugin-admin-script.js',
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



 add_action('admin_init','wpplugin_option_adder');
 function wpplugin_option_adder(){
    // $info = array("name"=>"preet", "location"=>"kharar");
    $data='save option updated data';
    if(!get_option('wpplugin_option')){
        add_option('wpplugin_option',$data);
    }
    update_option('wpplugin_option',$data);
 }
 bro bzerrorg