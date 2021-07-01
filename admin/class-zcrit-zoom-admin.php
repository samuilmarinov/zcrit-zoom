<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       Zcrit
 * @since      1.0.0
 *
 * @package    Zcrit_Zoom
 * @subpackage Zcrit_Zoom/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Zcrit_Zoom
 * @subpackage Zcrit_Zoom/admin
 * @author     Zcrit <Zcrit_Zoom@Zcrit.com>
 */
class Zcrit_Zoom_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Zcrit_Zoom_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Zcrit_Zoom_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/Zcrit_Zoom-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Zcrit_Zoom_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Zcrit_Zoom_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/Zcrit_Zoom-admin.js', array( 'jquery' ), $this->version, false);
    }
}
//SETTINGS PAGE
function Zcrit_Zoom_add_settings_page()
{
    add_options_page('Zcrit Zoom Settings', 'Zcrit-Zoom Settings', 'manage_options', 'Zcrit_Zoom', 'Zcrit_Zoom_render_plugin_settings_page');
}
add_action('admin_menu', 'Zcrit_Zoom_add_settings_page');
//SETTINGS PAGE RENDER
function Zcrit_Zoom_render_plugin_settings_page()
{
    ?>
    <h2>Zcrit-Zoom Settings</h2>
    <form action="options.php" method="post">
        <?php
        settings_fields('Zcrit_Zoom_options');
        do_settings_sections('Zcrit_Zoom'); ?>
        <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e('Save'); ?>" />
    </form>
    <?php
}
//REGISTER SETTINGS
function Zcrit_Zoom_register_settings()
{
    register_setting('Zcrit_Zoom_options', 'Zcrit_Zoom_options', 'Zcrit_Zoom_options_validate');
    add_settings_section('zcrit_settings', 'General Settings', 'Zcrit_Zoom_section_text', 'Zcrit_Zoom');
    add_settings_field('Zcrit_Zoom_setting_api_key', 'API Key', 'Zcrit_Zoom_setting_api_key', 'Zcrit_Zoom', 'zcrit_settings');
    add_settings_field('Zcrit_Zoom_setting_api_secret', 'API Secret', 'Zcrit_Zoom_setting_api_secret', 'Zcrit_Zoom', 'zcrit_settings');
    add_settings_field('Zcrit_Zoom_setting_leave_url', 'Leave meeting url', 'Zcrit_Zoom_setting_leave_url', 'Zcrit_Zoom', 'zcrit_settings');
    add_settings_field('Zcrit_Zoom_setting_meetings_url', 'Meetings url', 'Zcrit_Zoom_setting_meetings_url', 'Zcrit_Zoom', 'zcrit_settings');
    add_settings_field('Zcrit_Zoom_setting_sdk_build', 'Enable SDK', 'Zcrit_Zoom_setting_sdk_build', 'Zcrit_Zoom', 'zcrit_settings'); 
}
add_action('admin_init', 'Zcrit_Zoom_register_settings');
//SETTINGS PAGE INSTRUCTIONS
function Zcrit_Zoom_section_text()
{
    echo '<p>Create a private JWT App and insert the Client Api Key and Client Secret below. Enjoy !</p>';
    echo '<p>Use the following shortcode to display the zoom meeting button <span style="font-weight:bold;">[custom_zoom_shortcode]</span></p>';
    echo '<p>Use the following shortcode to display the zoom deactivate account button <span style="font-weight:bold;">[remove_zoom_shortcode]</span></p>';

}
//API KEY
function Zcrit_Zoom_setting_api_key()
{
    $options = get_option('Zcrit_Zoom_options');
    echo "<input id='Zcrit_Zoom_setting_api_key' name='Zcrit_Zoom_options[api_key]' type='text' value='" . esc_attr($options['api_key']) . "' />";
}
//API SECRET
function Zcrit_Zoom_setting_api_secret()
{
    $options = get_option('Zcrit_Zoom_options');
    echo "<input id='Zcrit_Zoom_setting_api_secret' name='Zcrit_Zoom_options[api_secret]' type='text' value='" . esc_attr($options['api_secret']) . "' />";
}
//LEAVE URL
function Zcrit_Zoom_setting_leave_url()
{
    $options = get_option('Zcrit_Zoom_options');
    echo "<input id='Zcrit_Zoom_setting_leave_url' name='Zcrit_Zoom_options[leave_url]' type='text' value='" . esc_attr($options['leave_url']) . "' />";
}
//MEETING URL
function Zcrit_Zoom_setting_meetings_url()
{
    $options = get_option('Zcrit_Zoom_options');
    echo "<input id='Zcrit_Zoom_setting_meetings_url' name='Zcrit_Zoom_options[meetings_url]' type='text' value='" . esc_attr($options['meetings_url']) . "' />";
}
//SDK URL
function Zcrit_Zoom_setting_sdk_build()
{
    $options = get_option('Zcrit_Zoom_options');
    if( !isset( $options['sdk_build'] ) ) $options['sdk_build'] = 0;
    $html = '<input type="checkbox" id="sdk_build" name="Zcrit_Zoom_options[sdk_build]" value="1"' . checked( 1, $options['sdk_build'], false ) . '/>';
    $html .= '<label for="sdk_build">Check to enable built-in SDK</label>';
    echo $html;

}