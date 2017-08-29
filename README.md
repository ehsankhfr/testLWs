testLW
======

## Setup

Please run the following for backend initialization:
```
composer install
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
```
For the client files generation, please run:
```
npm install
npm run build
```

## Run

To run server:
```
php bin/console server:run
```
