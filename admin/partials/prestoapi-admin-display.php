<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/3nomDev/PrestoAPI-Plugin
 * @since      1.0.0
 *
 * @package    PrestoAPI
 * @subpackage PrestoAPI/admin/partials
 */
?>

<?php
//flush rewrite rules when we load this page!
flush_rewrite_rules();
?>

<div class="wrap">
	<?php
	$tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';
	$this->prestoapi_render_tabs();
	?>
	<h2><?php echo esc_html(get_admin_page_title()); ?></h2>
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<div id="postbox-container-2" class="postbox-container">
				<?php
				switch ($tab) {
					case 'faq': ?>
						<h3>Q: Will my database information be secure?</h3>
						<span>A: The database info will only be visible to an admin of your PrestoAPI team. Your API will be secured through the selected Authentication type.
							Team Editors can create and modify endpoints that consume your WP data while Team Viewers can only perform Get requests.</span>
						<h3>Q: Who can setup the database connection?</h3>
						<span>A: Only an admin of your PrestoAPI team can receive the token and only an admin of the WP site can verify the token.</span>
						<h3>Q: My token is not validating!</h3>
						<span>A: You may have additional security parameters on your wp-config file. </span>
						<h3>Q: Having some issues with this plugin?</h3>
						<span>A: Please use GitHub for <a href="https://github.com/3nomDev/PrestoAPI-Plugin" target="_blank"><strong>issues, feature requests and more</strong></a>.</span>
					<?php
						break;
						// If no tab or general						
					default: ?>
						<div id="normal-sortables" class="meta-box-sortables ui-sortable">
							<div id="itsec_sss" class="postbox ">
								<h3 class="hndle"><span>Setup</span></h3>
								<div class="inside">
									<ol>
										<li>Sign into PrestoAPI <a href="https://prestoapi.com" target="_blank">here</a>.</li>
										<li>Click the 'WordPress Database' button from the Databases <a href="https://prestoapi.com/dashboard/databases" target="_blank">view</a>.</li>
										<li>Copy the access token</li>
										<li>Paste the access token in the field below</li>
										<li>Click validate and your WordPress database should appear in your list of databases.</li>
									</ol>
								</div>
							</div>
						</div>
						<?php
						if (isset($_POST['submit'])) {
							$token = $_POST['token_field'];
							$url = 'https://presto-staging.prestoapi.com/api/plugin/connect';
							$host = '';
							if (DB_HOST == 'localhost')
								$host = str_replace(array('http://', 'https://'), '', get_site_url());
							else
								$host = DB_HOST;
							$data = json_encode(array('server' => $host, 'dbName' => DB_NAME, 'username' => DB_USER, 'password' => DB_PASSWORD));
							$options = array(
								'http' => array(
									'method' => 'POST',
									'header' => array(
										"Content-type: application/json",
										"Authorization: $token"
									),
									'content' => $data
								)
							);
							$context = stream_context_create($options);
							$result = @file_get_contents($url, false, $context);
							if ($result === FALSE)
								echo '<h1 style="color:red;margin: 1rem 0;">Failed</h1>';
							else
								echo '<h1 style="color:green;margin: 1rem 0;">Success</h1>';
						}
						?>
						<form method="post">
							<div id="normal-sortables" class="meta-box-sortables ui-sortable">
								<div id="itsec_get_started" class="postbox ">
									<h3 class="hndle"><span>Validate Token</span></h3>
									<div class="inside">
										<label>Access Token</label>
										<input type="text" name="token_field" />
										<button id="submit" type="submit" name="submit" class="button button-primary">Validate</button>
									</div>
								</div>
							</div>
						</form>
				<?php
						break;
				}
				?>
			</div>
		</div>
	</div>
</div>