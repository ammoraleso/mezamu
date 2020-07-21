## Instalacion

 - Correr el siguiente comando:
   git clone https://github.com/ammoraleso/mezamu.git
 
 - Instalar composer y verificar version con 
    composer -v
    
 - Correr el siguiente comando para instalar dependencias
    composer install 
 
 - php artisan migrate:fresh
     
 - php artisan serve
 
 - Asegurarse que su archivo .env existe y si no existe solicitarlo al servicio tecnico,
 en el inicio es igual al .enx.example
 
 - Para crear la base de datos vaya a http://localhost/phpmyadmin/
    
 - Ejecute el siguiente comando php artisan migrate:fresh
    
## Instalacion AUTH

Modulo que se utiliza para la instalación de toda la parte de login y registro del framework.
(https://www.youtube.com/watch?v=ikmfpJLvpjI)

 - composer require laravel/ui
 - php artisan ui vue --auth
 - npm i
 - npm run dev