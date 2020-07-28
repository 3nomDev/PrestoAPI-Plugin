<?php

/**
 * @link              https://prestoapi.com/
 * @since             1.0.0
 * @package           PrestoAPI
 *
 * @wordpress-plugin
 * Plugin Name:       PrestoAPI
 * Plugin URI:        https://github.com/3nomDev/PrestoAPI-Plugin
 * Description:       Database connector for PrestoAPI
 * Version:           1.0.0
 * Author:            Andrew Samole
 * Author URI:        https://github.com/asamole
 * License:           GPL-3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

define('PLUGIN_VERSION', '1.0.0');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-prestoapi.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_PrestoAPI()
{

	$plugin = new PrestoAPI();
	$plugin->run();
}

run_PrestoAPI();
