/**
 * External dependencies
 */
const { resolve } = require( 'path' );

/**
 * WordPress dependencies
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

module.exports = {
	...defaultConfig,
	entry: {
		blocks: './js/src/index.js',
	},
	output: {
		path: resolve( __dirname, 'js/dist' ),
		filename: '[name].js',
	},
};
