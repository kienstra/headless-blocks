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
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_block_editor_scripts' ] );
		add_action( 'genesis_custom_blocks_add_blocks', [ $this, 'register_block' ] );
	}

	/**
	 * Registers the scripts for the block.
	 *
	 * Not simply enqueued here, as one of the scripts also is enqueued
	 * in the 'render_callback' of the block.
	 */
	public function enqueue_block_editor_scripts() {
		$this->enqueue_script( self::BLOCK_JS_SLUG );
	}

	/**
	 * Enqueues a script by its slug.
	 *
	 * @param string $slug The slug of the script.
	 */
	public function enqueue_script( $slug ) {
		$config = $this->get_script_config( $slug );

		\wp_enqueue_script(
			$this->get_prefixed_slug( $slug ),
			$this->plugin->get_script_path( $slug ),
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
	 * Registers the block.
	 */
	public function register_block() {
		add_block(
			'email-opt-in',
			[
				'title'    => 'Email Opt In',
				'category' => 'common',
				'icon'     => 'email',
				'fields'   => [
					'heading'            => [
						'label'   => __( 'Heading', 'headless-block' ),
						'control' => 'text',
					],
					'main-copy'          => [
						'label'   => __( 'Main Copy', 'headless-block' ),
						'control' => 'text',
					],
					'submission-message' => [
						'label'   => __( 'Submission Message', 'headless-block' ),
						'control' => 'text',
						'help'    => __( 'This will show on submitting the form', 'genesis-custom-blocks' ),
					],
					'button-text'        => [
						'label'   => __( 'Button Text', 'headless-block' ),
						'control' => 'text',
						'width'   => '50',
					],
				],
			]
		);
	}
}
