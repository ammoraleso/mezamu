## Instalacion

-   Correr el siguiente comando:
    git clone https://github.com/ammoraleso/mezamu.git

-   Instalar composer y verificar version con
    composer -v
-   Correr el siguiente comando para instalar dependencias
    composer install

-   php artisan migrate:fresh
-   php artisan serve

-   Asegurarse que su archivo .env existe y si no existe solicitarlo al servicio tecnico,
    en el inicio es igual al .enx.example

-   Para crear la base de datos vaya a http://localhost/phpmyadmin/
-   Ejecute el siguiente comando php artisan migrate:fresh

## Script Mezamu

Para correr ciertos comandos se creo el scrpipt mezamu.sh

-   Crear base de datos y añadir registros por defecto correr
    -   ./mezamu.sh build
-   Si la base de datos esta creada y se quiere añadir registros por defecto se deberá correr el siguiente comando
    -   ./mezamu.sh loaddb

## Instalacion AUTH

Modulo que se utiliza para la instalación de toda la parte de login y registro del framework.
(https://www.youtube.com/watch?v=ikmfpJLvpjI)

-   composer require laravel/ui
-   php artisan ui vue --auth
-   npm i
-   npm run dev

## Creacion Tables

Se deberá ejecutar el siguiente comando

-   php artisan migrate --path=/database/migrations/2014_10_12_000000_create_schedule_table.php

Si lanza un error se debera añadir un punto al inicio

-   php artisan migrate --path=./database/migrations/2014_10_12_000000_create_schedule_table.php

## Creacion Seeds

Se toma de ejemplo UserSeeder (https://stackoverflow.com/questions/52057513/add-multiple-rows-while-migration)

-   php artisan make:seeder UsersSeeder
-   Añadir el registro a insertar en UsersSeeder
-   Modificar DatabaseSeeder
-   Correr el comando php artisan db:seed

## Limpiar Memoria

php artisan cache:clear
composer dump-autoload

## Vue

-   npm install --save laravel-echo pusher-js
