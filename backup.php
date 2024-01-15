<?php 
require ('/home/bkp_from_git//php_mysql_dump/dump.php');

$dirsForBackup = [
'/home/GIR',
'/home/atv',
'/home/sites',
'/home/clients',
'/etc/nginx',
'/home/php_mysql_dump'
];

 
$dirsForBackup = file(__DIR__.'/backuplist.data', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
print_r($dirsForBackup);



foreach ($dirsForBackup as $path){
$command ="rsync -avhb --exclude '*/protected/runtime/*' --exclude '*.log' --delete --backup-dir=/home/bkp_from_git/bkp/backUpOld/c_$(date +%d.%m.%Y_%H:%M) $path /home/bkp_from_git/bkp";
echo exec ($command);
}

$log = date('Y-m-d H:i:s') . ' Скрипт отработал!';
file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);


?>
