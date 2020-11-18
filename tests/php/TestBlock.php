<?php
/**
 * Tests for class Block.
 *
 * @package HeadlessBlocks
 */

namespace HeadlessBlocks;

use stdClass;
use WP_Mock;
use Mockery;

/**
 * Tests for class Block.
 */
class TestBlock extends TestCase {

	/**
	 * Instance of Block.
	 *
	 * @var Block
	 */
	public $instance;

	/**
	 * Setup.
	 *
	 * @inheritdoc
	 */
	public function setUp() : void {
		parent::setUp();
		$plugin = new Plugin( dirname( dirname( __FILE__ ) ) );
		$plugin->init();
		$this->instance = new Block( $plugin );
	}

	/**
	 * Test __construct().
	 *
	 * @covers \HeadlessBlocks\Block::__construct()
	 */
	public function test_construct() {
		$this->assertEquals( __NAMESPACE__ . '\\Plugin', get_class( $this->instance->plugin ) );
	}

	/**
	 * Test init().
	 *
	 * @covers \HeadlessBlocks\Block::init()
	 */
	public function test_init() {
		WP_Mock::expectFilterAdded( 'render_block', [ $this->instance, 'render_serialized_block' ] );
		$this->instance->init();
	}

	/**
	 * Test render_serialized_block when on a block namespace that this should not change.
	 *
	 * @covers \HeadlessBlocks\Block::render_serialized_block()
	 */
	public function test_render_serialized_block_wrong_block_namespace() {
		$initial_content = '<p>Example</p>';

		$this->assertEquals(
			$initial_content,
			$this->instance->render_serialized_block(
				$initial_content,
				[
					'blockName' => 'core/paragraph',
				]
			)
		);
	}

	/**
	 * Test render_serialized_block when on a block namespace that this should not change.
	 *
	 * @covers \HeadlessBlocks\Block::render_serialized_block()
	 */
	public function test_render_serialized_block_correct_block_namespace() {
		$initial_content  = '<p>Here is initial content</p>';
		$block_name       = 'genesis-custom-blocks/a-test';
		$block_attributes = [ 'foo' => 'first' ];

		WP_Mock::userFunction( 'get_comment_delimited_block_content' )
			->once()
			->withArgs(
				[
					$block_name,
					$block_attributes,
					''
				]
			);

		$actual = $this->instance->render_serialized_block(
			$initial_content,
			[
				'blockName' => $block_name,
				'attrs'     => $block_attributes,
			]
		);

		$this->assertNotEquals( $actual, $initial_content );
	}
}
