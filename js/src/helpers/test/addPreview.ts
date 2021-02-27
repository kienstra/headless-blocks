/**
 * Internal dependencies
 */
import { addPreview } from '..';

describe( 'addPreview', () => {
	it( 'should add a preview of a block that is available', () => {
		expect(	addPreview( null, 'email-opt-in' ).length ).toStrictEqual( 1 );
	} );

	it( 'should not add a preview for the block because it is not available', () => {
		expect(	addPreview( null, 'block-name-not-available' ) ).toStrictEqual( null );
	} );
} );
