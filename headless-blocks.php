<?php
/**
 * Plugin bootstrap file.
 *
 * @package HeadlessBlocks
 */

namespace HeadlessBlocks;

/*
Plugin Name: React Blocks
Plugin URI: https://github.com/kienstra/headless-blocks
Description: A block that answers your questions.
Version: 0.1.0
Author: Ryan Kienstra
Author URI: https://ryankienstra.com
License: GPLv3
*/

require_once dirname( __FILE__ ) . '/vendor/autoload.php';

( new Plugin( __FILE__ ) )->init();
