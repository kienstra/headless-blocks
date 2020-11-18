<?php
/**
 * Class Block
 *
 * @package HeadlessBlocks
 */

namespace HeadlessBlocks;

/**
 * Class Block
 *
 * @package HeadlessBlocks
 */
class Block {

	/**
	 * The name of the block.
	 *
	 * @var string
	 */
	const BLOCK_NAMESPACE = 'genesis-custom-blocks';

	/**
	 * The plugin.
	 *
	 * @var Plugin
	 */
	public $plugin;

	/**
	 * Block constructor.
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
		add_filter( 'render_block', [ $this, 'render_serialized_block' ] );
	}

	/**
	 * For a certain block namespace, renders the block only as a comment.
	 *
	 * This allows parsing the block on the front-end,
	 * and rendering it with the props.
	 * There will be no block markup without additional rendering on the front-end.
	 *
	 *
	 * @param string $block_content The initial block content to filter.
	 * @param array  $block         The block data.
	 * @return string The block content.
	 */
	public function render_serialized_block( $block_content, $block ) {
		if (
				isset( $block['blockName'], $block['attrs'] )
				&&
				preg_match(
					'#^' . self::BLOCK_NAMESPACE . '/#',
					$block['blockName']
				)
		) {
			return get_comment_delimited_block_content( $block['blockName'], $block['attrs'], '' );
		}

		return $block_content;
	}
}
