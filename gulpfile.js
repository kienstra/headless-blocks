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
		'package/assets/*',
		'package/trunk/*',
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
	return run( 'mkdir -p package/assets package/trunk package/tags package/trunk/language' ).exec();
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

	return fs.writeFile( 'package/trunk/readme.txt', readme, cb );
} );

gulp.task( 'trunk', function() {
	return run( 'mv package/prepare/* package/trunk' ).exec();
} );

gulp.task( 'clean:bundle', function() {
	return del( [
		'package/trunk/package',
		'package/trunk/coverage',
		'package/trunk/js/src',
		'package/trunk/js/*.map',
		'package/trunk/css/*.map',
		'package/trunk/css/src',
		'package/trunk/bin',
		'package/trunk/built',
		'package/trunk/node_modules',
		'package/trunk/tests',
		'package/trunk/trunk',
		'package/trunk/gulpfile.js',
		'package/trunk/package*.json',
		'package/trunk/phpunit.xml',
		'package/trunk/phpcs.xml',
		'package/trunk/tsconfig.json',
		'package/trunk/README.md',
		'package/trunk/CHANGELOG.md',
		'package/trunk/CODE_OF_CONDUCT.md',
		'package/trunk/CONTRIBUTING.md',
		'package/trunk/webpack.config.js',
		'package/trunk/.github',
		'package/trunk/SHASUMS*',
		'package/prepare',
	] );
} );

gulp.task( 'copy:tag', function() {
	return run( 'export BUILD_VERSION=$(grep "Version" headless-blocks.php | cut -f4 -d" "); [ -z "$BUILD_VERSION" ] && exit 1; mkdir -p package/tags/$BUILD_VERSION/; rm -rf package/tags/$BUILD_VERSION/*; cp -r package/trunk/* package/tags/$BUILD_VERSION/' ).exec();
} );

gulp.task( 'create:zip', function() {
	return run( 'cp -r package/trunk package/headless-blocks; export BUILD_VERSION=$(grep "Version" headless-blocks.php | cut -f4 -d" "); cd package; pwd; zip -r headless-blocks.$BUILD_VERSION.zip headless-blocks/; echo "ZIP of build: $(pwd)/headless-blocks.$BUILD_VERSION.zip"; rm -rf headless-blocks' ).exec();
} );

gulp.task( 'default', gulp.series(
	'verify:versions',
	'remove:bundle',
	'install:dependencies',
	'run:build',
	'bundle',
	'prepare',
	'readme',
	'trunk',
	'clean:bundle',
	'copy:tag',
	'create:zip'
) );
