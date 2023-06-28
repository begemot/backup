<?php 
$dirsForBackup = [
'/home/GIR',
'/home/atv',
'/home/sites',
'/home/clients',
'/etc/nginx',
'/home/php_mysql_dump'
];

 
$dirsForBackup = file('./exclude.data', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
print_r($dirsForBackup);
return;

foreach ($dirsForBackup as $path){
$command ="rsync -avhb --exclude '*/protected/runtime/*' --exclude '*.log' --delete --backup-dir=/bkp/bacUpOld/c_$(date +%d.%m.%Y_%H:%M) $path /bkp";
echo exec ($command);
}


?>
