/**
 * External dependencies
 */
import * as React from 'react';

/**
 * Internal dependencies
 */
import * as previewComponents from '../components';
import { dashToPascalCase } from './';

/**
 * Adds a preview component to the filter.
 *
 * @param {null|React.Component} initialPreview The initial preview component, or null.
 * @param {string} blockName The block name, without the namespace.
 * @return {null|React.Component} An alternate component, or null if there is none.
 */
const addPreview = ( initialPreview, blockName ) => {
	const componentName = dashToPascalCase( blockName );
	return previewComponents[ componentName ] ? previewComponents[ componentName ] : initialPreview; /* eslint-disable-line import/namespace */
};

export default addPreview;
