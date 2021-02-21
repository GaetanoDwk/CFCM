REM svuota tabella tools
mysql -u root cfcm -e "TRUNCATE TABLE tools";

REM decrementa di 1 i giorni mancanti alla scadenza del caso
mysql -u root cfcm -e "UPDATE CASO SET caso.ca_ggres = DATEDIFF(ca_datadel, DATE(NOW()))-1";

REM decrementa di 1 i giorni mancanti alla scadenza della lavorazione
mysql -u root cfcm -e "UPDATE lavorazione SET ggrestanti = DATEDIFF(dfine, NOW()) WHERE ggrestanti > 0";

REM backup del database
mysqldump -u root cfcm --single-transaction --quick --lock-tables=false > C:\xampp\htdocs\cfcm\cfcm.sql

robocopy "C:\xampp\htdocs\cfcm" "C:\cfcm\sync" /mir  /r:0  /XA:SH  /fft /XJ