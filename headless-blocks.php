<?php
/**
 * Plugin bootstrap file.
 *
 * @package HeadlessBlocks
 */

namespace HeadlessBlocks;

/*
Plugin Name: Headless Blocks
Plugin URI: https://github.com/kienstra/headless-blocks
Description: A block that answers your questions.
Version: 0.1.0
Author: Ryan Kienstra, Phil Johnston
Author URI: https://wpengine.com
License: GPLv2 or later
*/

require_once dirname( __FILE__ ) . '/vendor/autoload.php';

( new Plugin( __FILE__ ) )->init();
