# Campaign manager API

Dockerized implementation of a campaign manager API

## Description
- During the initialization process, the database fills up with data to simulate the state of a production application.
- For testing purposes, a **Postman collection** can be found in the root of the repository.
- The unit tests can be run with the following command
- - `docker exec -it campaign_manager_php php artisan test`
- Keep in mind, that security has not been a top priority during the developement of this application, which is why credentials are not separated well.
- For some reason, performance is way slower on Windows without WSL, than with WSL or native Unix.


## Prerequisites
- Make sure you **have docker installed** on your local machine, you **do not need** to have **php** / **postresql** installed on your machine

## Installation

- Clone this repository 
-  - `git clone https://github.com/Steffra/campaign_manager.git && cd campaign_manager`
- Run command: `docker-compose up --build -d`
- Run the initialization steps:
-  - `docker exec -it campaign_manager_php cp .env.example .env && docker exec -it campaign_manager_php composer install && docker exec -it campaign_manager_php php artisan migrate --force && docker exec -it campaign_manager_php php artisan db:seed --force && docker exec -it campaign_manager_php php artisan key:generate --force`
- After this, the API will be available on `localhost:8000`

# Endpoints
These endpoints are available on the `localhost:8000/api` route

## Campaign related endpoints

-  `/campaigns` - **GET** - returns all the campaigns in the database
-  `/campaign/{id}` - **GET** - returns data of the campaign with the given id
-  `/approveCampaign/{id}` - **POST** - approves the given campaign
-  `/disapproveCampaign/{id}` - **POST** - disapproves the given campaign
-  `/activateCampaign/{id}` - **POST** - activates the given campaign
-  `/inactivateCampaign/{id}` - **POST** - inactivates the given campaign

## Blogpost related endpoints

-  `/posts` - **GET** - returns all the blogposts in the database
-  `/post/{id}` - **GET** - returns data of the blogpost with the given id
-  `/publicatePost/{id}` - **POST** - publicates the given blogpost

## Coupon related endpoints

-  `/coupons` - **GET** - returns all the coupons in the database
-  `/coupon/{id}` - **GET** - returns data of the coupon with the given id
-  `/activateCoupon/{id}` - **POST** - publicates the given coupon

## Product related endpoints

-  `/products` - **GET** - returns all the products in the database
-  `/product/{id}` - **GET** - returns data of the product with the given id
-  `/publicateProduct/{id}` - **POST** - publicates the given product

