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
		blocks: './js/src/index.ts',
	},
	module: {
		rules: [
			{
				test: /\.[jt]sx?$/,
				use: [ 'ts-loader' ],
				exclude: /node_modules/,
			},
		],
	},
	resolve: {
		extensions: [ '.js', '.ts', '.tsx' ],
	},
	output: {
		path: resolve( __dirname, 'js/dist' ),
		filename: '[name].js',
	},
};
