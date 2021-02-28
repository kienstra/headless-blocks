/**
 * External dependencies
 */
const del = require( 'del' );
const fs = require( 'fs' );
const gulp = require( 'gulp' );
const run = require( 'gulp-run' );

gulp.task( 'verify:versions', function() {
	return run( 'php bin/verify-versions.php' ).exec();
} );

gulp.task( 'remove:bundle', function() {
	return del( [
		'package/build/*',
	] );
} );

gulp.task( 'install:dependencies', function() {
	return run( 'composer install -o --no-dev' ).exec();
} );

gulp.task( 'run:build', function() {
	return run( 'npm run build' ).exec();
} );

gulp.task( 'bundle', function() {
	return gulp.src( [
		'**/*',
		'!bin/**/*',
		'!node_modules/**/*',
		'!composer.*',
		'!js/src/**/*',
		'!js/tests/**/*',
		'!js/coverage/**/*',
		'!package/**/*',
	] )
		.pipe( gulp.dest( 'package/prepare' ) );
} );

gulp.task( 'prepare', function() {
	return run( 'mkdir -p package/build package/build/language' ).exec();
} );

gulp.task( 'readme', function( cb ) {
	const changelog = fs.readFileSync( './CHANGELOG.md' ).toString();

	const readme = fs.readFileSync( './README.md' )
		.toString()
		.concat( '\n' + changelog )
		.replace( new RegExp( '###', 'g' ), '=' )
		.replace( new RegExp( '##', 'g' ), '==' )
		.replace( new RegExp( '#', 'g' ), '===' )
		.replace( new RegExp( '__', 'g' ), '*' );

	return fs.writeFile( 'package/build/readme.txt', readme, cb );
} );

gulp.task( 'build', function() {
	return run( 'mv package/prepare/* package/build' ).exec();
} );

gulp.task( 'clean:bundle', function() {
	return del( [
		'package/build/package',
		'package/build/coverage',
		'package/build/js/src',
		'package/build/js/*.map',
		'package/build/css/*.map',
		'package/build/css/src',
		'package/build/bin',
		'package/build/built',
		'package/build/node_modules',
		'package/build/tests',
		'package/build/build',
		'package/build/gulpfile.js',
		'package/build/package*.json',
		'package/build/phpunit.xml',
		'package/build/phpcs.xml',
		'package/build/tsconfig.json',
		'package/build/README.md',
		'package/build/CHANGELOG.md',
		'package/build/CODE_OF_CONDUCT.md',
		'package/build/CONTRIBUTING.md',
		'package/build/webpack.config.js',
		'package/build/.github',
		'package/build/SHASUMS*',
		'package/prepare',
	] );
} );

gulp.task( 'create:zip', function() {
	return run( 'cp -r package/build package/headless-blocks; export BUILD_VERSION=$(grep "Version" headless-blocks.php | cut -f4 -d" "); cd package; pwd; zip -r headless-blocks.$BUILD_VERSION.zip headless-blocks/; echo "ZIP of build: $(pwd)/headless-blocks.$BUILD_VERSION.zip"; rm -rf headless-blocks' ).exec();
} );

gulp.task( 'finish', function() {
	return run( 'echo "Finished! The .zip file is at package/headless-blocks.*.*.*.zip. Do composer install to resume development, as this removed non-production dependencies."' ).exec();
} );

gulp.task( 'default', gulp.series(
	'verify:versions',
	'remove:bundle',
	'install:dependencies',
	'run:build',
	'bundle',
	'prepare',
	'readme',
	'build',
	'clean:bundle',
	'create:zip',
	'finish'
) );
