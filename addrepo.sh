#!/bin/bash
NAME="$1"

curl  https://api.github.com/user/repos -d '{"name":"'$NAME'"}' -H "Authorization: token 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"

git init
git add -A
git commit -m "first commit"
git remote add origin git@github.com:kos7xm/$NAME.git
git push -u origin master