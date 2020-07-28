<?php

/**
 * Controls settings of plugin
 *
 * @package    PrestoAPI
 * @subpackage PrestoAPI/admin/settings
 */
class PrestoAPI_Settings extends PrestoAPI_Admin
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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $PrestoAPI       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct($PrestoAPI)
	{
		$this->id    = 'general';
		$this->label = __('General', 'woocommerce');
		$this->PrestoAPI = $PrestoAPI;
	}

	/**
	 * Creates our settings sections with fields etc. 
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function settings_api_init()
	{
		$this->settings_post_api_init();
		$this->settings_user_api_init();
	}

	/**
	 * Creates post settings sections with fields etc. 
	 *
	 * @since    1.1.0
	 * @access   public
	 */
	public function settings_post_api_init()
	{

		// Example usage: 
		// register_setting( $option_group, $option_name, $settings_sanitize_callback );
		register_setting(
			$this->PrestoAPI . '_options',
			$this->PrestoAPI . '_options',
			array($this, 'settings_sanitize')
		);

		// Example usage: 
		// add_settings_section( $id, $title, $callback, $menu_slug );
		add_settings_section(
			$this->PrestoAPI . '-display-options', // section
			apply_filters($this->PrestoAPI . '-display-section-title', __('', $this->PrestoAPI)),
			array($this, 'display_options_section'),
			$this->PrestoAPI
		);

		// Example usage: 
		// add_settings_field( $id, $title, $callback, $menu_slug, $section, $args );
		add_settings_field(
			'disable-filter',
			apply_filters($this->PrestoAPI . '-disable-filter-label', __('Disable Filter', $this->PrestoAPI)),
			array($this, 'disable_filter_options_field'),
			$this->PrestoAPI,
			$this->PrestoAPI . '-display-options' // section to add to
		);
	}

	/**
	 * Creates user settings sections with fields etc. 
	 *
	 *
	 * @since    1.1.0
	 * @access   public
	 */
	public function settings_user_api_init()
	{
		// Example usage: 
		// register_setting( $option_group, $option_name, $settings_sanitize_callback );
		register_setting(
			$this->PrestoAPI . 'user_options',
			$this->PrestoAPI . 'user_options',
			array($this, 'settings_sanitize')
		);

		// Example usage: 
		// add_settings_section( $id, $title, $callback, $menu_slug );
		add_settings_section(
			$this->PrestoAPI . '-user-display-options', // section
			apply_filters($this->PrestoAPI . '-user-display-section-title', __('', $this->PrestoAPI)),
			array($this, 'display_options_section'),
			$this->PrestoAPI
		);

		// Example usage: 
		// add_settings_field( $id, $title, $callback, $menu_slug, $section, $args );
		add_settings_field(
			'disable-filter',
			apply_filters($this->PrestoAPI . '-disable-filter-user-label', __('Disable User Filter', $this->PrestoAPI)),
			array($this, 'disable_filter_user_options_field'),
			$this->PrestoAPI,
			$this->PrestoAPI . '-user-display-options' // section to add to
		);
	}

	/**
	 * Creates a settings section
	 *
	 * @since 		1.0.0
	 * @param 		array 		$params 		Array of parameters for the section
	 * @return 		mixed 						The settings section
	 */
	public function display_options_section($params)
	{

		echo '<p>' . $params['title'] . '</p>';
	} // display_options_section()

	/**
	 * Enable Filter Field
	 *
	 * @since 		1.0.0
	 * @return 		mixed 			The settings field
	 */
	public function disable_filter_options_field()
	{

		$options 	= get_option($this->PrestoAPI . '_options');
		$option 	= 0;

		if (!empty($options['disable-filter'])) {
			$option = $options['disable-filter'];
		}
?>
		<input type="text" id="<?php echo $this->PrestoAPI; ?>_options[disable-filter]" name="<?php echo $this->PrestoAPI; ?>_options[disable-filter]" value="1" <?php checked($option, 1, true); ?> />
<?php
	}
}
