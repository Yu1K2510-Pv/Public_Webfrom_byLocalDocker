@echo off
SET CURRENT_DIR=%~dp0

cd %CURRENT_DIR%
docker-compose up -d
exit

