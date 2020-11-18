/**
 * WordPress dependencies
 */
import { addFilter } from '@wordpress/hooks';

/**
 * Internal dependencies
 */
import { addPreview } from './helpers';

addFilter(
	'genesisCustomBlocks.alternatePreview',
	'headlessBlocks/addPreview',
	addPreview
);
