# Headless Blocks

Use interactive React components on the front-end.

Contributors: [ryankienstra](https://profiles.wordpress.org/ryankienstra), [johnstonphilip](https://profiles.wordpress.org/johnstonphilip/)
Tags: [blocks](https://wordpress.org/plugins/tags/blocks), [headless](https://wordpress.org/plugins/tags/headless)
Requires at least: 5.5
Tested up to: 5.5
Stable tag: 0.1.0
License: GPLv2 or later
Donate link: http://jdrf.org/get-involved/ways-to-donate/
Requires PHP: 7.3

![Jest Tests](https://github.com/kienstra/headless-blocks/actions/workflows/test-js.yml/badge.svg)
![PHPUnit Tests](https://github.com/kienstra/headless-blocks/actions/workflows/test-php.yml/badge.svg)
![Lint All](https://github.com/kienstra/headless-blocks/actions/workflows/lint-all.yml/badge.svg)

## Description ##

Your custom blocks, optimized for headless.

1. Write the front-end of your blocks as React components in your Next.js repo's blocks/ directory.
1. Give this plugin the URL of your Next.js repo with `bash bin/setup.sh`
1. This plugin will import those blocks and display them in Gutenberg.

![headless-block-editor](https://user-images.githubusercontent.com/4063887/109378623-c4ae0380-7899-11eb-8f47-53eebb33240f.gif)

## Setup ##

1. Install this [.zip](https://github.com/studiopress/genesis-custom-blocks/files/6059880/genesis-custom-blocks.1.1.0.zip) of Genesis Custom Blocks, a dependency of this plugin
1. Clone this repo into `wp-content/plugins/`
1. `cd headless-blocks`
1. `nvm use`
1. `./bin/setup.sh`
1. Follow the prompt to enter the name and URL of your headless front-end repo. That will make this plugin import the blocks from that repo.
1. `npm run build`
1. Or to watch for changes: `npm run dev`
