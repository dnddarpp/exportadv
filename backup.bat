@echo off
set current=%date:~10,4%%date:~4,2%%date:~7,2%
set filename="D:\backups\exportadv-%current%.sql"
set filename2="D:\backups\exportadv-%current%.zip"
echo %filename%
cd "D:\backups"
C:\Program Files\MySQL\MySQL Server 5.1\bin\mysqldump.exe exportadv --user=root --password=root --host="127.0.0.1" --port=instancePort --result-file=%filename% --default-character-set=utf8 --single-transaction=TRUE
echo backup-finished
