/**
 * Internal dependencies
 */
import addPreview from '../addPreview';

jest.mock( 'getting-started/blocks/dist', () => ( {
	'genesis-custom-blocks/email-opt-in': () => {},
} ) );

describe( 'addPreview', () => {
	it( 'should add a preview of a block that is available', () => {
		expect(	addPreview( null, 'genesis-custom-blocks/email-opt-in' ) ).toBeTruthy();
	} );

	it( 'should not add a preview for the block because it is not available', () => {
		expect(	addPreview( null, 'foo-namespace/non-existent-block' ) ).toStrictEqual( null );
	} );
} );
