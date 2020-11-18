/**
 * Internal dependencies
 */
import { dashToPascalCase } from '../';

describe( 'dashToPascalCase', () => {
	it.each( [
		[
			'example',
			'Example',
		],
		[
			'example-block',
			'ExampleBlock',
		],
		[
			'long-block-name-that-keeps-going-on-and-on',
			'LongBlockNameThatKeepsGoingOnAndOn',
		],
		[
			'',
			'',
		],
	] )( 'should get a PascalCase string', ( dashCase, expected ) => {
		expect( dashToPascalCase( dashCase ) ).toStrictEqual( expected );
	} );
} );
