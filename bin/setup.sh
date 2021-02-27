#!/bin/bash

echo
echo "What's the full URL of your headless front-end repo, ending in .git?"
echo "This is the URL you'd use with git clone <url>, like https://github.com/foo/foo-baz.git"
echo
read repo

sed -i '' -E "s#(\"headless-front-end\": \")[^\"]+#\1$repo#" package.json

echo "Thanks, that repo is now set in your package.json, installing that package…"

npm install
git add package.json package-lock.json

echo "Committing that change…"
git commit -m "Set the headless-front-end package to the repo"
