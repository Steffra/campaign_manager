# Campaign manager API

Dockerized implementation of a campaign manager API

## Description
- For some reason, performance is way slower on Windows without WSL, than with WSL or native Unix.
- Durin the initialization process, the database gets filled up with data to simulate the state of a production application.
- For testing purposes, a Postman collection can be found in the root of the repository.
- The unit test can be run with the following command
- - `docker exec -it campaign_manager_php php artisan test`
- Keep in mind, that security has not been a top priority during the developement of this application, which is why credentials are not separated well.

## Prerequisites
- Make sure you **have docker installed** on your local machine, you **do not need** to have **php** / **postresql** / node installed on your machine

## Installation

- Clone this repository 
-  - `git clone https://github.com/Steffra/campaign_manager.git && cd campaign_manager`
- Run command: `docker-compose up --build -d`
- Run the initialization steps:
-  - `docker exec -it campaign_manager_php cp .env.example .env && docker exec -it campaign_manager_php composer install && docker exec -it campaign_manager_php php artisan migrate --force && docker exec -it campaign_manager_php php artisan db:seed --force && docker exec -it campaign_manager_php php artisan key:generate --force`