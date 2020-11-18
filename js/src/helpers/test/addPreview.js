/**
 * Internal dependencies
 */
import { addPreview } from '../';

describe( 'addPreview', () => {
	it( 'should add a preview for the block', () => {
		const actual = addPreview( null, 'example', {} );
		expect(
			actual.length
		).toStrictEqual( 1 );
	} );
} );
