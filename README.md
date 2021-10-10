# Campaign manager API

Docker development implementation the campaign manager:

- Nginx
- PostgreSQL
- PHP8.0
- Vue
- Node

## Installation

- Clone this repository `git clone git@github.com:Steffra/campaign_manager.git`
- Make sure you have docker installed on your local machine, you do not need to have php / mysql / redis / node installed on your machine
- Run command: `docker-compose up --build -d`
- Run the initialization steps: `docker exec -it campaign_manager_php php artisan migrate && docker exec -it campaign_manager_php php artisan db:seed && docker exec -it campaign_manager_php php artisan key:generate`