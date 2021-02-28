# Headless Blocks

Use interactive React components on the front-end.

**Contributors:** [ryankienstra](https://profiles.wordpress.org/ryankienstra), [johnstonphilip](https://profiles.wordpress.org/johnstonphilip/)
**Tags:** [blocks](https://wordpress.org/plugins/tags/blocks), [headless](https://wordpress.org/plugins/tags/headless)
**Requires at least:** 5.5
**Tested up to:** 5.5
**Stable tag:** 0.1.0
**License:** GPLv2 or later
**Donate link:** http://jdrf.org/get-involved/ways-to-donate/
**Requires PHP:** 7.3

[![Build Status](https://api.travis-ci.com/kienstra/headless-blocks.svg)](https://travis-ci.org/kienstra/headless-blocks) [![Built with Grunt](https://gruntjs.com/cdn/builtwith.svg)](http://gruntjs.com)

## Description ##

Your custom blocks, optimized for headless.

1. Write the front-end of your blocks as React components in your Next.js repo's blocks/ directory.
1. Give this plugin the URL of your Next.js repo with `bash bin/setup.sh`
1. This plugin will import those blocks and display them in Gutenberg.

![headless-block-editor](https://user-images.githubusercontent.com/4063887/109378623-c4ae0380-7899-11eb-8f47-53eebb33240f.gif)

## Installation ##

1. Install this [.zip](https://github.com/studiopress/genesis-custom-blocks/files/6026023/genesis-custom-blocks.1.1.0.zip) of Genesis Custom Blocks, a dependency of this plugin
1. Clone this repo into `wp-content/plugins/`
1. `cd headless-blocks`
1. `nvm use # ensure npm is on the right version`
1. `./bin/setup.sh`
1. Follow the prompt to enter the URL of your headless front-end repo
1. `npm run build`
1. Or to watch for changes: `npm run dev`

## Changelog ##

### 0.1.0 ###
- Initial release
- Use the block components from the headless repo, so the block editor can display those
