/**
 * Capitalizes the first character in a string.
 *
 * @param {string} name The string to capitalize.
 * @return {string} The capitalized string.
 */
const capitalize = ( name ) => name.charAt( 0 ).toUpperCase() + name.slice( 1 );

/**
 * Gets a PascalCase string from a snake_case one.
 *
 * @param {string} dashCase A dashed string, like 'example-block'.
 * @return {string} A PascalCase string.
 */
const dashToPascalCase = ( dashCase ) => {
	return dashCase
		.split( '-' )
		.reduce( ( accumulator, currentValue ) => {
			return capitalize( accumulator ) + capitalize( currentValue );
		}, '' );
};

export default dashToPascalCase;
