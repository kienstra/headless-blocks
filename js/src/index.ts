/**
 * WordPress dependencies
 */
import { addFilter } from '@wordpress/hooks';

/**
 * Internal dependencies
 */
import addPreview from './helpers/addPreview';

addFilter(
	'genesisCustomBlocks.reactPreview',
	'headlessBlocks/addPreview',
	addPreview
);
