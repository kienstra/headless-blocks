<?php
/**
 * Tests for class Asset.
 *
 * @package HeadlessBlocks
 */

namespace HeadlessBlocks;

use stdClass;
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
		$plugin         = new Plugin( dirname( dirname( __FILE__ ) ) );
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
	 * @covers \HeadlessBlocks\Asset::init()
	 * @throws \Brain\Monkey\Expectation\Exception\ExpectationArgsRequired If the expectation args are wrong.
	 */
	public function test_init() {
		Functions\expect( 'add_action' )->once()->with(
			'enqueue_block_editor_assets',
			[ $this->instance, 'enqueue_block_editor_script' ]
		);
		Functions\expect( 'add_action' )->once()->with(
			'genesis_custom_blocks_template_path',
			[ $this->instance, 'get_blocks_directory' ]
		);

		$this->instance->init();
	}

	/**
	 * Test enqueue_block_editor_script.
	 *
	 * @covers \HeadlessBlocks\Asset::enqueue_block_editor_script()
	 */
	public function test_enqueue_block_editor_script() {
		Functions\expect( 'wp_enqueue_script' )
			->once();

		$this->instance->enqueue_block_editor_script();
	}

	/**
	 * Test enqueue_gcb_editor_script on the wrong screen.
	 *
	 * @covers \HeadlessBlocks\Asset::enqueue_gcb_editor_script()
	 */
	public function test_enqueue_gcb_editor_script_wrong_screen() {
		$screen            = new stdClass();
		$screen->post_type = 'page';
		$screen->base      = 'post';

		Functions\expect( 'get_current_screen' )
			->andReturn( $screen );
		Functions\expect( 'wp_enqueue_script' )
			->never();

		$this->instance->enqueue_gcb_editor_script();
	}

	/**
	 * Test enqueue_gcb_editor_script on the correct screen.
	 *
	 * @covers \HeadlessBlocks\Asset::enqueue_gcb_editor_script()
	 */
	public function test_enqueue_gcb_editor_script_correct_screen() {
		$screen            = new stdClass();
		$screen->post_type = 'genesis_custom_block';
		$screen->base      = 'post';

		Functions\expect( 'get_current_screen' )
			->andReturn( $screen );
		Functions\expect( 'wp_enqueue_script' )
			->once();

		$this->instance->enqueue_gcb_editor_script();
	}
}
