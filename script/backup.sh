# Svuota tabella tools
mariadb -u admin -ppassw0rd cfcm -e "TRUNCATE TABLE tools";
sleep 1
# Backup del database
mysqldump -u admin -ppassw0rd cfcm --single-transaction --quick --lock-tables=false > /var/www/html/cfcm/cfcm.sql
sleep 1
sudo tar -cvf /home/cfcm/Backups/cfcm-"$(date +"%d-%m-%Y-%h-%m-%s")".tar /var/www/html/cfcm/
