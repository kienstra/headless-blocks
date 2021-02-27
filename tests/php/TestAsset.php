<?php
/**
 * Tests for class Asset.
 *
 * @package HeadlessBlocks
 */

namespace HeadlessBlocks;

use WP_Mock;

/**
 * Tests for class Asset.
 */
class TestAsset extends TestCase {

	/**
	 * Instance of Asset.
	 *
	 * @var Asset
	 */
	public $instance;

	/**
	 * Setup.
	 *
	 * @inheritdoc
	 * @return void
	 */
	public function setUp() : void {
		parent::setUp();
		WP_Mock::userFunction( 'plugins_url' );
		$plugin = new Plugin( dirname( dirname( __FILE__ ) ) );
		$plugin->init();
		$this->instance = new Asset( $plugin );
	}

	/**
	 * Test __construct.
	 *
	 * @covers \HeadlessBlocks\Plugin::__construct()
	 */
	public function test_construct() {
		$this->assertEquals( __NAMESPACE__ . '\\Plugin', get_class( $this->instance->plugin ) );
	}

	/**
	 * Test init.
	 *
	 * @covers \HeadlessBlocks\Plugin::init()
	 */
	public function test_init() {
		WP_Mock::expectActionAdded( 'enqueue_block_editor_assets', [ $this->instance, 'enqueue_block_editor_scripts' ] );
		WP_Mock::expectActionAdded( 'genesis_custom_blocks_template_path', [ $this->instance, 'get_blocks_directory' ] );
		$this->instance->init();
	}

	/**
	 * Test enqueue_block_editor_scripts.
	 *
	 * @covers \HeadlessBlocks\Plugin::enqueue_block_editor_scripts()
	 */
	public function test_enqueue_block_editor_scripts() {
		WP_Mock::userFunction( 'wp_enqueue_script' )
			->once()
			->withSomeOfArgs( 'headless-blocks-blocks' );

		$this->instance->enqueue_block_editor_scripts();
	}
}
