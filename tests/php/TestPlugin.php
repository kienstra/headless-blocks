<?php
/**
 * Tests for class Plugin.
 *
 * @package HeadlessBlocks
 */

namespace HeadlessBlocks;

use Brain\Monkey\Functions;
use Brain\Monkey;

/**
 * Tests for class Plugin.
 */
class TestPlugin extends TestCase {

	/**
	 * Instance of plugin.
	 *
	 * @var Plugin
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
		$this->instance = new Plugin( dirname( dirname( __FILE__ ) ) );
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
	 * Test init().
	 *
	 * @covers \HeadlessBlocks\Plugin::init()
	 */
	public function test_init() {
		Functions\expect( 'add_action' )->once()->with(
			'init',
			[ $this->instance, 'plugin_localization' ]
		);

		$this->instance->init();
	}

	/**
	 * Test init_classes.
	 *
	 * @covers \HeadlessBlocks\Plugin::init_classes()
	 */
	public function test_init_classes() {
		$this->instance->init_classes();
		foreach ( [ 'Asset', 'Block' ] as $class ) {
			$this->assertEquals( __NAMESPACE__ . '\\' . $class, get_class( $this->instance->components->$class ) );
		}
	}

	/**
	 * Test plugin_localization().
	 *
	 * @covers \HeadlessBlocks\Plugin::plugin_localization()
	 * @throws \Brain\Monkey\Expectation\Exception\ExpectationArgsRequired
	 */
	public function test_plugin_localization() {
		Functions\expect( 'load_plugin_textdomain' )
			->once()
			->with( 'headless-blocks', false, basename( dirname( __FILE__ ) ) . '/languages' );

		$this->instance->plugin_localization();
	}

	/**
	 * Test get_path.
	 *
	 * @covers \HeadlessBlocks\Plugin::get_path()
	 */
	public function test_get_path() {
		$this->assertIsString( $this->instance->get_path() );
	}

	/**
	 * Test get_dir.
	 *
	 * @covers \HeadlessBlocks\Plugin::get_dir()
	 */
	public function test_get_dir() {
		$this->assertIsString( $this->instance->get_dir() );
	}

	/**
	 * Test get_script_path.
	 *
	 * @covers \HeadlessBlocks\Plugin::get_script_path()
	 */
	public function test_get_script_path() {
		Functions\expect( 'plugins_url' )
			->once()
			->andReturnFirstArg();
		$slug = 'example';

		$this->assertStringContainsString( "js/dist/{$slug}.js", $this->instance->get_script_path( $slug ) );
	}

	/**
	 * Test get_style_path.
	 *
	 * @covers \HeadlessBlocks\Plugin::get_style_path()
	 */
	public function test_get_style_path() {
		Functions\expect( 'plugins_url' )
			->once()
			->andReturnFirstArg();
		$slug = 'foo-style';

		$this->assertStringContainsString( "{$slug}.css", $this->instance->get_style_path( $slug ) );
	}
}
