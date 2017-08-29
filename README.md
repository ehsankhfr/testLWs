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
1. Symfony (Backend): as it(as a framework) gives us the power to have wrapper for all the possible php low-level features, e.g. super global varibales, response handling ...
2. AngularJs (Frontend): as it gives us the ability to design the application with a completely modular structure

One of the enjoyable points of symfony is the cli tool that it provides to auto-create both creation and migration of the project. I used it for many parts, including entity creation and controller initialization. For the backend side, all of the used libraries are taken from the Symfony itself. All the routings are done by the annotations(decoration pattern).

For the frontend section, I used jQuery for the easier html operation handling, lodash for easier data processing, bootstrap for responsive design, ui-router for a better and more structured routing.

## How to use

The application was inteded to work with usernames as email address, however in the current version the email address validation for the username is removed and the application accepts any username string with 2<=length<=15 and password with 2<=length<=30.

Any login with a new username will cause auto-registration of the user information. Any repeated username for the login will need the currect password to be entered.
