REM svuota tabella tools
mysql -u root cfcm -e "TRUNCATE TABLE tools";

REM decrementa di 1 i giorni mancanti alla scadenza del caso
mysql -u root cfcm -e "UPDATE CASO SET caso.ca_ggres = DATEDIFF(ca_datadel, DATE(NOW()))-1";

REM setta il nome del file zip inserendo anche un timestamp
set NAME=CFCM-%DATE:/=-%@%TIME::=-%.7z

REM backup del database
mysqldump -u root cfcm --single-transaction --quick --lock-tables=false > C:\xampp\htdocs\cfcm\cfcm.sql

REM crea il pacchetto zip nella cartella
7z a C:\cfcm\backup\%NAME% ../*
