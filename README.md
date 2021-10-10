# Campaign manager API

Dockerized implementation of a campaign manager API

## Prerequisitions
- Make sure you **have docker installed** on your local machine, you **do not need** to have **php** / **postresql** / node installed on your machine

## Installation

- Clone this repository 
-  - `git clone https://github.com/Steffra/campaign_manager.git && cd campaign_manager`
- Run command: `docker-compose up --build -d`
- Run the initialization steps:
-  - `docker exec -it campaign_manager_php cp .env.example .env && docker exec -it campaign_manager_php composer install && docker exec -it campaign_manager_php php artisan migrate --force && docker exec -it campaign_manager_php php artisan db:seed --force && docker exec -it campaign_manager_php php artisan key:generate --force`