# Headless Blocks Guide To Contributing

## Development Setup

```
$ cd path/to/wp-content/plugins/
$ git clone git@github.com:kienstra/headless-blocks
$ cd headless-blocks
$ composer install && npm install
$ npm run dev
```

If you add a new class while developing, add the class name to `Plugin::$classes` so that it's instantiated:

```php
/**
 * This plugin's PHP classes.
 *
 * @var array
 */
public $classes = [ 'Asset', 'Block' ];
```

## Tests

```
$ npm run test:php # PHPUnit
$ npm run test:js # Jest
```
