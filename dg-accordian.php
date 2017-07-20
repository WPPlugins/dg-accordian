<?php

/**
* The plugin bootstrap file
*
* This is accordian plugin for wordpress
* You can add accordian from shortcode and widget
*
* @link              http://dinesh-ghimire.com.np/
* @since             1.0.0
* @package           Dg_Accordian
*
* @wordpress-plugin
* Plugin Name:       DG Accordian
* Plugin URI:        http://projects.dinesh-ghimire.com.np/accordian/
* Description:       This is accordian plugin.
* Version:           1.1.0
* Author:            Dinesh Ghimire
* Author URI:        http://dinesh-ghimire.com.np/
* License:           GPL-2.0+
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
* Text Domain:       dg-accordian
* Domain Path:       /languages
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
die;
}

/**
* The code that runs during plugin activation.
* This action is documented in includes/class-dg-accordian-activator.php
*/
function activate_dg_accordian() {
require_once plugin_dir_path( __FILE__ ) . 'includes/class-dg-accordian-activator.php';
Dg_Accordian_Activator::activate();
}

/**
* The code that runs during plugin deactivation.
* This action is documented in includes/class-dg-accordian-deactivator.php
*/
function deactivate_dg_accordian() {
require_once plugin_dir_path( __FILE__ ) . 'includes/class-dg-accordian-deactivator.php';
Dg_Accordian_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dg_accordian' );
register_deactivation_hook( __FILE__, 'deactivate_dg_accordian' );

/**
* The core plugin class that is used to define internationalization,
* admin-specific hooks, and public-facing site hooks.
*/
require plugin_dir_path( __FILE__ ) . 'includes/class-dg-accordian.php';

/**
* Begins execution of the plugin.
*
* Since everything within the plugin is registered via hooks,
* then kicking off the plugin from this point in the file does
* not affect the page life cycle.
*
* @since    1.0.0
*/
function run_dg_accordian() {

$plugin = new Dg_Accordian();
$plugin->run();

}
run_dg_accordian();
