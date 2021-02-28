/**
 * External dependencies
 */
import * as React from 'react';

/**
 * Internal dependencies
 */
import { addPreview } from '..';

jest.mock( 'getting-started/blocks/dist', () => ( {
	'genesis-custom-blocks/email-opt-in': () => {},
} ) );

describe( 'addPreview', () => {
	it( 'should add a preview of a block that is available', () => {
		expect(	addPreview( null, 'email-opt-in' ) ).toBeTruthy();
	} );

	it( 'should not add a preview for the block because it is not available', () => {
		expect(	addPreview( null, 'block-name-not-available' ) ).toStrictEqual( null );
	} );
} );
