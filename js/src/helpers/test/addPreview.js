/**
 * Internal dependencies
 */
import { addPreview } from '../';

describe( 'addPreview', () => {
	it( 'should not add a preview for the block because it has the wrong namespace', () => {
		expect(	addPreview( null, 'example', {} ).length ).toStrictEqual( 1 );
	} );
} );
