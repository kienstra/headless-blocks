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
 *
 * @param {React.Component[]|null} initialPreview The initial preview component, if any.
 * @param {string} blockNameWithNamespace The GCB block name, starting with the namespace of genesis-custom-blocks/.
 */
const addPreview = ( initialPreview: React.Component[] | null, blockNameWithNamespace: string ): React.Component[] | null | any => {
	return blockComponents[ blockNameWithNamespace ]
		? blockComponents[ blockNameWithNamespace ]
		: initialPreview;
};

export default addPreview;
