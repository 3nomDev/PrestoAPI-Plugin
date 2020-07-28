<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    PrestoAPI
 * @subpackage PrestoAPI/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    PrestoAPI
 * @subpackage PrestoAPI/admin
 * @author     Andrew Samole <andrewsamole@gmail.com>
 */
class PrestoAPI_Admin
{


	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $PrestoAPI    The ID of this plugin.
	 */
	private $PrestoAPI;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The tabs of settings page
	 * @since 1.0.0
	 * @access public
	 * @var array 	$plugin_settings_tabs	The tabs of this plugin.
	 */
	public $plugin_settings_tabs = array();

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $PrestoAPI       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($PrestoAPI, $version)
	{

		$this->PrestoAPI = $PrestoAPI;
		$this->version = $version;

		$this->plugin_settings_tabs['general'] = 'General';
		$this->plugin_settings_tabs['faq'] = 'FAQs';
	}

	/**
	 * Register the Settings page.
	 *
	 * @since    1.0.0
	 */
	public function prestoapi_admin_menu()
	{
		add_options_page(__('PrestoAPI', $this->PrestoAPI), __('PrestoAPI', $this->PrestoAPI), 'manage_options', $this->PrestoAPI, array($this, 'display_plugin_admin_page'));
	}

	/**
	 * Settings - Validates saved options
	 *
	 * @since 		1.0.0
	 * @param 		array 		$input 			array of submitted plugin options
	 * @return 		array 						array of validated plugin options
	 */
	// public function settings_sanitize($input)
	// {

	// 	// Initialize the new array that will hold the sanitize values
	// 	$new_input = array();

	// 	if (isset($input)) {
	// 		// Loop through the input and sanitize each of the values
	// 		foreach ($input as $key => $val) {
	// 			$new_input[$key] = sanitize_text_field($val);
	// 		}
	// 	}

	// 	return $new_input;
	// } // sanitize()

	/**
	 * Renders Settings Tabs
	 *
	 * @since 		1.0.0
	 * @return 		mixed 			The settings field
	 */
	function prestoapi_render_tabs()
	{
		$current_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';

		screen_icon();
		echo '<h2 class="nav-tab-wrapper">';
		foreach ($this->plugin_settings_tabs as $tab_key => $tab_caption) {
			$active = $current_tab == $tab_key ? 'nav-tab-active' : '';
			echo '<a class="nav-tab ' . $active . '" href="?page=' . $this->PrestoAPI . '&tab=' . $tab_key . '">' . $tab_caption . '</a>';
		}
		echo '</h2>';
	}

	/**
	 * Plugin Settings Link on plugin page
	 *
	 * @since 		1.0.0
	 * @return 		mixed 			The settings field
	 */
	function add_settings_link($links)
	{
		$mylinks = array(
			'<a href="' . admin_url('options-general.php?page=prestoapi') . '">Settings</a>',
		);
		return array_merge($links, $mylinks);
	}

	/**
	 * Callback function for the admin settings page.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page()
	{
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/prestoapi-admin-display.php';
	}

	/**
	 * Returns plugin for settings page
	 *
	 * @since    	1.0.0
	 * @return 		string    $PrestoAPI       The name of this plugin
	 */
	public function get_plugin()
	{
		return $this->PrestoAPI;
	}
}
