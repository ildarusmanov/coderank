#!/bin/bash
php ./yii topcoder/parse
php ./yii codeforces/parse
php ./yii atcoder/parse
echo "updated" > ./web/rank_update.log
