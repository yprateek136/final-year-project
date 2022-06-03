<?php
$DATABASE="pennydia_db";
$DBUSER="root";
$DBPASSWD="Pennydia@2020!";

$PATH="/var/www/html/www.pennydia.com/cronjobs/";
$FILE_NAME=$DATABASE."-" . date("Y-m-d") . ".sql.gz";
exec('/usr/bin/mysqldump -u '.$DBUSER.' -p'.$DBPASSWD.' '.$DATABASE.' | gzip --best > '.$PATH.$FILE_NAME);
echo "Database(".$DATABASE.") backup completed. File name: ".$FILE_NAME;
?>


