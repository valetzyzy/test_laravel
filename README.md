Urls:

Clients:
- create client `POST http://localhost:8038/api/client`
- get all clients `GET http://localhost:8038/api/client`
- get specific client `GET http://localhost:8038/api/client/1`
- delete specific client `DELETE http://localhost:8038/api/client/1`
- update specific client `PUT http://localhost:8038/api/client/1`

Project:

- create project `POST http://localhost:8038/api/project`
- get all projects `GET http://localhost:8038/api/project`
- get specific project `GET http://localhost:8038/api/project/1`
- delete specific project `DELETE http://localhost:8038/api/project/1`
- update specific project `PUT http://localhost:8038/api/project/1`



### Install

- run `docker-compose up -d`
- run `docker exec -it test_laravel_app_1 bash`
- run `cp .env.example .env`
- run `composer install`
- run `php artisan key:generate`
- run `php artisan migrate`
- run `php artisan db:seed`
- use API on URL [http://localhost:8038](http://localhost:8038)
#### To Run test

- run `docker exec -it test_laravel_app_1 bash`
- run `vendor/bin/phpunit`

