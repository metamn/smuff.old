#!/bin/sh
echo Removing old files ..
rm -f ujsmuff.*

echo Dumping database ...
mysqldump -u ujsmuff -p5FJFuy6Ff6bHNCcs ujsmuff | gzip > ujsmuff.sql.gz

echo Encrypting the compressed dump ...
openssl enc -e -bf -in ujsmuff.sql.gz -out ujsmuff.sql.gz.enc -k almafa-12-smuff
# to decrypt: openssl -d bf ...

echo Emailing results ...
mutt root@localhost -s "db backup" -a /home/cs/backup/ujsmuff.sql.gz.enc < /dev/null

echo Success

