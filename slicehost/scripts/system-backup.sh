echo "Starting incremental encrypted backup ..."
sudo duplicity --exclude /proc --exclude /media --exclude /mnt --exclude /dev --exclude /sys --exclude /tmp --exclude /home/cs/backup / file:///home/cs/backup
echo "# verify backup ..."
sudo duplicity verify --exclude /proc --exclude /media --exclude /mnt --exclude /dev --exclude /sys --exclude /tmp --exclude /home/cs/backup file:///home/cs/backup /
echo "# chowning backup files ..."
sudo chown cs /home/cs/backup/duplicity*
echo "Done."

echo "To sync to Dropbox/UbuntuOne run this on the client:"
echo "scp -P 30000 cs@173.203.94.129:backup/duplicity* Dropbox/"



