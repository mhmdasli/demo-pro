
# Demo App
this project is a basic PHP MVC system ,as demo the system
 hosts sample site and admin area in tow separate themes, these themes are affiliate market site that shows the products and admin area used fo CRUD.


# Packages used

## Backend
##### composer/composer
used for auto loading classes and managing dependencies.

##### symfony/httpFoundation: 
used for handling request/response object.

##### twig/twig: 
templating engine to manage the html themes.

## Frontend
##### bootstrap:
 framework for building the html views.
 
##### jquery:
 specially for manipulating the DOM.
 
##### frameworkJs:
 custom js library that handle the ajax requests by using html data-attributes.  

## Local installation
clone and install composer 

add .env file to your root and include this variables
```.dotenv
APP_NAME=Demo
APP_DEBUG=True
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

ADMIN_LOGIN=
ADMIN_PASSWORD=
```
* to use the admin area you must fill the admin password and login

* If you plan on using a database, create database in your local server and run this command:

```shell
php appInstall
```

## Contact

You can communicate with me using the following E-mail: m.ali2910@gmail.com

## Coding standards

Please follow the following guides and code standards:

* [PSR 4 Coding Standards](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md)
* [Twigs](https://twig.symfony.com/)
* [Bootstrap](https://getbootstrap.com/)
* [jQuery](https://jquery.com/)
