# WebTSS
An open-source web alternative to tsssaver.

## Installation 
1. Drag and drop this projects files into a web directory.
2. Allow write access to the "tss" folder.
3. Configure cron.php to run on a schedule. (On linux you can use crontab -e)
4. Import tss.sql into a mysql server.
5. Configure database information in config.php.

## Requirements
- PHP 5+
- MySQL server
- PHP MySQLi extension
- Access to a cron/trigger for cron.php
- Preferrably linux
