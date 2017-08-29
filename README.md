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
## The implementation description

I chose 2 frameworks for the project:
1. Symfony (Backend): as it gives us the power to have wrapper for all the possible php low-level features, e.g. super global varibales, response handling ...
2- AngularJs (Frontend): as it gives us the ability to design the application with a completely modular structure
