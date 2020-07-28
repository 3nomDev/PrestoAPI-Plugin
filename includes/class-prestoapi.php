<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/3nomDev/PrestoAPI-Plugin
 * @since      1.0.0
 *
 * @package    PrestoAPI
 * @subpackage PrestoAPI/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    PrestoAPI
 * @subpackage PrestoAPI/includes
 * @author     Andrew Samole <andrewsamole@gmail.com>
 */
class PrestoAPI
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      PrestoAPI_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $PrestoAPI    The string used to uniquely identify this plugin.
	 */
	protected $PrestoAPI;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		$this->version = PLUGIN_VERSION;
		$this->PrestoAPI = 'prestoapi';

		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - PrestoAPI_Loader. Orchestrates the hooks of the plugin.
	 * - PrestoAPI_i18n. Defines internationalization functionality.
	 * - PrestoAPI_Admin. Defines all hooks for the admin area.
	 * - PrestoAPI_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-prestoapi-loader.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-prestoapi-admin.php';

		/**
		 * The class responsible for defining all Settings.
		 */
		// require_once plugin_dir_path(dirname(__FILE__)) . 'admin/settings/class-prestoapi-settings.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-prestoapi-public.php';

		$this->loader = new PrestoAPI_Loader();
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{
		$plugin_admin = new PrestoAPI_Admin($this->get_PrestoAPI(), $this->get_version());

		//$settings_init_general = new PrestoAPI_Settings($this->get_PrestoAPI());

		$this->loader->add_action('admin_menu', $plugin_admin, 'prestoapi_admin_menu');
		//$this->loader->add_action('admin_init', $settings_init_general, 'settings_api_init');
		$this->loader->add_filter('plugin_action_links_prestoapi/prestoapi.php', $plugin_admin, 'add_settings_link');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{
		$plugin_public = new PrestoAPI_Public($this->get_PrestoAPI(), $this->get_version());

		// $this->loader->add_action('rest_prepare_post', $plugin_public, 'apply_post_filter');
		//$this->loader->add_action( 'rest_prepare_user', $plugin_public, 'apply_user_filter' );

		/* 
		 * DEBUG MODE
		 */
		// $this->loader->add_action('rest_prepare_user', $plugin_public, 'apply_debug_filter');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_PrestoAPI()
	{
		return $this->PrestoAPI;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    PrestoAPI_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}
