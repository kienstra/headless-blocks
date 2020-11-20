/**
 * External dependencies
 */
import * as React from 'react';

/**
 * Internal dependencies
 */
import { blockComponents } from 'headless-block-components';

/**
 * Adds a preview component to the filter.
 *
 * @param {null|React.Component} initialPreview The initial preview component, or null.
 * @param {string} blockName The block name, without the namespace.
 * @return {null|React.Component} An alternate component, or null if there is none.
 */
const addPreview = ( initialPreview, blockName ) => {
	const fullBlockName = `genesis-custom-blocks/${ blockName }`;
	return blockComponents[ fullBlockName ] ? blockComponents[ fullBlockName ] : initialPreview; /* eslint-disable-line import/namespace */
};

export default addPreview;
