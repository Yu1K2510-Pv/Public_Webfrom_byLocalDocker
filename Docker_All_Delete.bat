@chcp 65001
@echo off
SET CURRENT_DIR=%~dp0

@echo on
@echo "※※　削除するDockerサービスはすべて停止させてください！　※※"
@SET /P "カレントディレクトリに構築したDocker環境をすべて削除します。よろしいですか？（y/n）" 

docker container prune

exit