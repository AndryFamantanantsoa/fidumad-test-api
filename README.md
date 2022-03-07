fidumad-test-api
=========
##### Pré-requis
- Php ^7.3|^8.0
- Nodejs 
- npm
- Composer

##### Installation et configuration
~~~ console
$ git clone https://github.com/AndryFamantanantsoa/fidumad-test-api.git
$ cd fidumad-test-api
$ composer install
$ npm install
~~~

##### Configurer l'API
1. si vous avez une installation de docker sur votre machine, vous pouvez lancer directement la comande suivante pour avoir accès à l'API dans le port 3000
~~~ console
$ docker-compose up
~~~
Si vous voullez prendre les sorces directement en local, vous pouvez la prendre ici https://github.com/maximesimoncelli/api_test et puis de faire un npm run start

2. lancer l'application
~~~ console
$ php artisan serve
$ npm run watch
~~~
    
Accéder à l'application sur [http://localhost:8000](http://localhost:8000)
