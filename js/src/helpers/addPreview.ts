/**
 * External dependencies
 */
import * as React from 'react';

/**
 * Internal dependencies
 */
import blockComponents from 'getting-started/blocks/dist';

/**
 * Adds a preview component to the filter.
 */
const addPreview = ( initialPreview: React.Component[] | null, blockName: String ): React.Component[] | null | any => {
	const fullBlockName = `genesis-custom-blocks/${ blockName }`;
	return blockComponents[ fullBlockName ]
		? blockComponents[ fullBlockName ]
		: initialPreview;
};

export default addPreview;
