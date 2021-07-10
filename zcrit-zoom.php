<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              Zcrit
 * @since             1.0.0
 * @package           Zcrit_Zoom
 *
 * @wordpress-plugin
 * Plugin Name:       Zcrit-Zoom
 * Plugin URI:        Zcrit-Zoom
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Zcrit
 * Author URI:        Zcrit
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       zcrit-zoom
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('ZCRIT_ZOOM_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-zcrit-zoom-activator.php
 */
function activate_zcrit_zoom()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-zcrit-zoom-activator.php';
    Zcrit_Zoom_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-zcrit-zoom-deactivator.php
 */
function deactivate_zcrit_zoom()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-zcrit-zoom-deactivator.php';
    Zcrit_Zoom_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_zcrit_zoom');
register_deactivation_hook(__FILE__, 'deactivate_zcrit_zoom');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-zcrit-zoom.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_zcrit_zoom()
{
    $plugin = new Zcrit_Zoom();
    //ZCRIT USER AND PASS sarah@zcrit.com f189a84e42ba7c943c65b8373562498c catherine@zcrit.com bc2143772000d1f6a475191b9f9642ab
    function zcrit_get_user() {
        $zcrit_email = 'catherine@zcrit.com';
        $zcrit_pass = 'bc2143772000d1f6a475191b9f9642ab';
        return array($zcrit_email,$zcrit_pass);
    }
    //ZCRIT USER AND PASS
    //START
    add_action('wp_head', 'wordpress_frontend_ajaxurl');
    function wordpress_frontend_ajaxurl()
    {
        echo '<script type="text/javascript">
            var ajaxurl = "' . admin_url('admin-ajax.php') . '";
          </script>';
    }
    //Plugin Settings
    function action_links($links)
    {
        $links = array_merge(array(
                '<a href="' . esc_url(admin_url('/options-general.php?page=Zcrit_Zoom')) . '">' . __('Settings', 'Zcrit-Zoom') . '</a>'
            ), $links);
        return $links;
    }
    add_action('plugin_action_links_' . plugin_basename(__FILE__), 'action_links');
    //Zoom Call Shortcode
    function html_zcrit_zoom_code()
    {
        global $wp;
        global $wp_query;
        include plugin_dir_path(__FILE__) . 'includes/main-template.php';
    }
    //Zoom Remove Shortcode
    function html_zcrit_zoom_remove()
    {
        global $wp;
        global $wp_query;
        include plugin_dir_path(__FILE__) . 'includes/main-template-remove.php';
    }
    //CREATE MEETING
    add_action('wp_ajax_zcrit_zoom_action', 'zcrit_zoom_action_callback');
    function zcrit_zoom_action_callback()
    {
        global $wpdb; // access to the database
        $zcritzoom = intval($_POST['zcritzoom']);
        include plugin_dir_path(__FILE__) . 'includes/get-zoom.php';
    //  $zcritzoom += 10;
    //  echo $zcritzoom;
      die(); 
    }
    //CREATE USER
    add_action('wp_ajax_zcrit_zoom_user_action', 'zcrit_zoom_user_action_callback');
    function zcrit_zoom_user_action_callback()
    {
        global $wpdb; // access to the database
        $zcritzoomuser = intval($_POST['zcritzoomuser']);
        $current_user = wp_get_current_user();
        $current_user_id = $current_user->ID;
        include plugin_dir_path(__FILE__) . 'includes/create-user.php';
        sleep(45); 
        $emailoperator_return = include plugin_dir_path(__FILE__) . 'includes/mail-operator.php';
        if($emailoperator_return != 'FAIL'){
            add_user_meta( $current_user_id, 'ZOOM_ACTIVE', '1', true);
            include plugin_dir_path(__FILE__) . 'includes/mail-operator.php';
        }else{
            print_r('FAIL');
        }
    //  $zcritzoomuser += 10;
    //  echo $zcritzoomuser;
      die(); 
    }
    //DELETE USER
    add_action('wp_ajax_zcrit_zoom_user_delete_action', 'zcrit_zoom_user_delete_action_callback');
    function zcrit_zoom_user_delete_action_callback()
    {
        global $wpdb; // access to the database
        $zcritzoomuserdelete = intval($_POST['zcritzoomuserdelete']);
        include plugin_dir_path(__FILE__) . 'includes/delete-user.php';
        $current_user = wp_get_current_user();
        $current_user_id = $current_user->ID;
        delete_user_meta($current_user_id, 'ZOOM_ACTIVE');
    //  $zcritzoomuserdelete += 10;
    //  echo $zcritzoomuser;
      die(); 
    }
    // [custom_zoom_shortcode]
    // $zcrit_email = 'catherine@zcrit.com';
    // $zcrit_pass = 'bc2143772000d1f6a475191b9f9642ab';
    function shortcode_zoom_call()
    {   
        ob_start();
        html_zcrit_zoom_code();
        return ob_get_clean();
    }
    add_shortcode('custom_zoom_shortcode', 'shortcode_zoom_call');
    // [remove_zoom_shortcode]
    function shortcode_zoom_remove()
    {
        ob_start();
        html_zcrit_zoom_remove();
        return ob_get_clean();
    }
    add_shortcode('remove_zoom_shortcode', 'shortcode_zoom_remove');
    //END
    $plugin->run();
}
run_zcrit_zoom();
