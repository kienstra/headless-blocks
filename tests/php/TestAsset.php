<?php
/**
 * Tests for class Asset.
 *
 * @package HeadlessBlocks
 */

namespace HeadlessBlocks;

use Brain\Monkey\Functions;
use Brain\Monkey;

/**
 * Tests for class Asset.
 */
class TestAsset extends TestCase {

	/**
	 * The asset object.
	 *
	 * @var Asset
	 */
	public $instance;

	/**
	 * Sets up each test.
	 *
	 * @inheritdoc
	 */
	public function setUp() : void {
		parent::setUp();
		Monkey\setUp();
		Functions\stubs( [ 'plugins_url' ] );
		$plugin = new Plugin( dirname( dirname( __FILE__ ) ) );
		$this->instance = new Asset( $plugin );
	}

	/**
	 * Tears down after each test.
	 *
	 * @inheritdoc
	 */
	public function tearDown() : void {
		Monkey\tearDown();
		parent::tearDown();
	}

	/**
	 * Test init.
	 *
	 * @covers \HeadlessBlocks\Plugin::init()
	 * @throws \Brain\Monkey\Expectation\Exception\ExpectationArgsRequired
	 */
	public function test_init() {
		Functions\expect( 'add_action' )->once()->with(
			'enqueue_block_editor_assets',
			[ $this->instance, 'enqueue_block_editor_scripts' ]
		);
		Functions\expect( 'add_action' )->once()->with(
			'genesis_custom_blocks_template_path',
			[ $this->instance, 'get_blocks_directory' ]
		);

		$this->instance->init();
	}

	/**
	 * Test enqueue_block_editor_scripts.
	 *
	 * @covers \HeadlessBlocks\Plugin::enqueue_block_editor_scripts()
	 */
	public function test_enqueue_block_editor_scripts() {
		Functions\expect( 'wp_enqueue_script' )
			->once()
			->withSomeOfArgs( 'headless-blocks-blocks' );

		$this->instance->enqueue_block_editor_scripts();
	}
}
