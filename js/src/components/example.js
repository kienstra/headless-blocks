/**
 * External dependencies
 */
import * as React from 'react';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';

/**
 * @typedef {Object} ExampleProps
 * @property {Object} attributes The block attributes.
 */

/**
 * An example block component.
 *
 * @param {ExampleProps} props
 * @return {React.ReactElement} An example preview component.
 */
const Example = ( { attributes } ) => (
	<div>
		<p>{ __( 'This is an alternate preview component', 'headless-blocks' ) }</p>
		<p>{ __( 'Here is the value of the new-field attribute, if it exists:', 'headless-blocks' ) }</p>
		<p>{ attributes[ 'new-field' ] }</p>
	</div>
);

export default Example;
