# Svuota tabella tools
mariadb -u root -ppassw0rd cfcm -e "TRUNCATE TABLE tools";
sleep 1
# Backup del database
mysqldump -u root -ppassw0rd cfcm --single-transaction --quick --lock-tables=false > /var/www/html/cfcm/cfcm.sql
sleep 1
cp -r /var/www/html/cfcm /home/cfcm/Backups/cfcm-"$(date +"%d-%m-%Y")"
