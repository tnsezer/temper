# Quooker Docker configuration
***
This is the Quooker Docker installation. Please follow the steps below to get it up and running.

## Pre-installation
***
Make sure you have docker-machin installed: 
[Docker installation guide](https://source.youwe.nl/projects/YWMAG2/repos/magento2-docker/browse)

## Project installation
***
_No need to create the database it's created when starting the containers._
Copy and rename .env.sample to .env and entered your *IP* and *USERNAME*

```bash
cd docker && docker-compose up -d
```
>The `-d` will make docker run in the background, leave this off when you want to debug or see the logs.

## Uninstall
***
_Remove the database directories inside the project_
```bash
cd docker && docker-compose down
sudo rm -Rf mysql/db_storage elastic-search/es_storage redis/redis_storage 
```

