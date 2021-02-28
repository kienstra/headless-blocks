#!/bin/bash

echo
echo "In your headless front-end repo, what is the value of \"name\" in its root package.json?"
echo "For example, the \"name\" of this is \"getting-started\": https://github.com/kienstra/headless-wordpress/blob/ee93bcfbb72c446b78e09c8687c13361e258b1fc/package.json#L2"
echo
read repo_name

echo
echo "Thanks! What's the full URL of your headless front-end repo, ending in .git?"
echo "This is the URL you'd use with git clone <url>, like https://github.com/foo/foo-baz.git"
echo
read repo_url

sed -i '' -E "s#\"getting-started\": \"[^\"]+#\"$repo_name\": \"$repo_url#" package.json
sed -i '' -E "s#node_modules/getting-started/blocks#node_modules/$repo_name/blocks#" package.json

sed -i '' -E "s#from 'getting-started/blocks#from '$repo_name/blocks#" js/src/helpers/addPreview.ts js/src/helpers/test/addPreview.ts
sed -i '' -E "s#getting-started/blocks#$repo_name/blocks#" js/src/helpers/test/addPreview.ts

echo "Thanks, that repo is now set in your package.json, installing the packages…"
composer install && npm install
git add package.json package-lock.json

echo "Committing that change…"
git commit -m "Set the headless-front-end package to the repo"

echo "Success! Do 'wp plugin activate headless-blocks && npm run dev' to start using this"
