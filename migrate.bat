@echo off
echo Running Database Migrations and Seeders...
..\php_latest\php.exe artisan migrate:fresh --seed
pause
