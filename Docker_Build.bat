@chcp 65001
@echo off
SET CURRENT_DIR=%~dp0

@echo on
@SET /P ANSWER="カレントディレクトリにDocker環境を構築します。よろしいですか？（y/n）" 

@echo off

if /i {%ANSWER%}=={y} (goto :YES)
if /i {%ANSWER%}=={yes} (goto :YES)

EXIT

:YES

docker-compose up -–build
pause
exit
