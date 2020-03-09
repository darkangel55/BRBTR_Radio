<?php
/**
 * The plugin BRBTR Radio
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Plugin_Name
 *
 * @wordpress-plugin
 * Plugin Name:       BRBTR Radio
 * Plugin URI:        http://example.com/plugin-name-uri/
 * Description:       My Radiolka
 * Version:           1.0.0
 * Author:            DarkAngel
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       brbtr-radio
 * Domain Path:       /languages
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
if( ! defined( 'ABSPATH' ) ) {
    die;
}

// global $table_prefix;

define( 'BRBTR_PLUGIN_VERSION', '1.0.0' );
define( 'BRBTR_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'BRBTR_PLUGIN_FILE', __FILE__ );
define( 'BRBTR_TABLE_NAME', 'brbtr_station_list' );

if ( version_compare( PHP_VERSION, '5.6', '<' ) ) {
    function brbtr_incompatible_admin_notice() {
        echo '<div class="error"><p>' . __( 'BRBTR Radio requires PHP 5.6 (or higher) to function properly. Please upgrade PHP. The Plugin has been auto-deactivated.', 'brbtr' ) . '</p></div>';
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
    }
    function brbtr_deactivate_self() {
        deactivate_plugins( plugin_basename( BRBTR_PLUGIN_FILE ) );
    }
    add_action( 'admin_notices', 'brbtr_incompatible_admin_notice' );
    add_action( 'admin_init', 'brbtr_deactivate_self' );
    return;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-brbtr-radio-activator.php
 */
function activate_brbtr_radio() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-brbtr-radio-activator.php';
	BRBTR_Radio_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
// function deactivate_plugin_name() {
// 	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name-deactivator.php';
// 	Plugin_Name_Deactivator::deactivate();
// }

register_activation_hook( __FILE__, 'activate_brbtr_radio' );
// register_deactivation_hook( __FILE__, 'deactivate_plugin_name' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-brbtr-radio.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_brbtr_radio() {

	$plugin = new BRBTR_Radio();
	$plugin->run();

}
run_brbtr_radio();
