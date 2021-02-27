/**
 * External dependencies
 */
import * as React from 'react';

/**
 * Internal dependencies
 */
import blockComponents from '@getting-started/blocks/dist';

/**
 * Adds a preview component to the filter.
 */
const addPreview = ( initialPreview: React.Component[] | null, blockName: String ): React.Component[] | null | any => {
	const fullBlockName = `genesis-custom-blocks/${ blockName }`;
	// @ts-ignore
	const block = blockComponents[ fullBlockName ] ? blockComponents[ fullBlockName ] : initialPreview;
	return block /* eslint-disable-line import/namespace */
};

export default addPreview;
