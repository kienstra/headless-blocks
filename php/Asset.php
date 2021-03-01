<?php
/**
 * Class Asset
 *
 * @package HeadlessBlocks
 */

namespace HeadlessBlocks;

use function Genesis\CustomBlocks\add_block;

/**
 * Class Asset
 *
 * @package HeadlessBlocks
 */
class Asset {

	/**
	 * The slug of the block JS file.
	 *
	 * @var string
	 */
	const BLOCK_JS_SLUG = 'blocks';

	/**
	 * The plugin.
	 *
	 * @var Plugin
	 */
	public $plugin;

	/**
	 * Asset constructor.
	 *
	 * @param Plugin $plugin The instance of the plugin.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
	}

	/**
	 * Inits the class.
	 */
	public function init() {
		\add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_block_editor_script' ] );
		\add_action( 'admin_footer', [ $this, 'enqueue_gcb_editor_script' ] );
		\add_action( 'genesis_custom_blocks_template_path', [ $this, 'get_blocks_directory' ] );
	}

	/**
	 * Enqueues the script for the block.
	 */
	public function enqueue_block_editor_script() {
		$this->enqueue_script();
	}

	public function enqueue_gcb_editor_script() {
		$screen = \get_current_screen();

		if (
			isset( $screen->post_type, $screen->base ) &&
			'genesis_custom_block' === $screen->post_type &&
			'post' === $screen->base
		) {
			$this->enqueue_script();
		}
	}

	/**
	 * Enqueues a script.
	 */
	public function enqueue_script() {
		$config = $this->get_script_config( self::BLOCK_JS_SLUG );

		\wp_enqueue_script(
			$this->get_prefixed_slug( self::BLOCK_JS_SLUG ),
			$this->plugin->get_script_path( self::BLOCK_JS_SLUG ),
			$config['dependencies'],
			$config['version'],
			true
		);
	}

	/**
	 * Gets the slug of the asset, prefixed with the plugin slug.
	 * For example, 'headless-blocks-block'.
	 *
	 * @param string $asset_slug The slug of the asset.
	 * @return string $full_slug The slug of the asset, prepended with the plugin slug.
	 */
	public function get_prefixed_slug( $asset_slug ) {
		return Plugin::SLUG . '-' . $asset_slug;
	}

	/**
	 * Gets the config of the script, including dependencies.
	 *
	 * @param string $slug The slug of the script.
	 * @return array The config of the script.
	 */
	private function get_script_config( $slug ) {
		$plugin_path = $this->plugin->get_dir();
		return require "{$plugin_path}/js/dist/{$slug}.asset.php";
	}

	/**
	 * Gets the blocks directory in this plugin.
	 *
	 * @param string $path The initial blocks directory.
	 * @return string The path of the block directory
	 */
	public function get_blocks_directory( $path ) {
		unset( $path );
		return $this->plugin->get_dir();
	}
}
