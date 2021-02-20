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
 */
const addPreview = ( initialPreview: React.Component[] | null, blockName: string ): React.Component[] | null | any => {
	const fullBlockName = `genesis-custom-blocks/${ blockName }`;
	return blockComponents[ fullBlockName ] ? blockComponents[ fullBlockName ] : initialPreview; /* eslint-disable-line import/namespace */
};

export default addPreview;
