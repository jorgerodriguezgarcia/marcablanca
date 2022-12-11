# 🚀 Instalación del proyecto

## Requisitos

PHP 8.1 y Composer 2

## Instalación repositorio y dependencias
````
git clone https://github.com/jorgerodriguezgarcia/marcablanca.git -b master
cd marcablanca
composer install
````

## Configuramos la conexión a la base de datos

Ajustar a datos particulares de cada servidor 
````
echo DATABASE_URL="mysql://root@127.0.0.1:3306/marcablanca?serverVersion=8&charset=utf8mb4" > .env.local
echo DATABASE_URL="mysql://root@127.0.0.1:3306/marcablanca?serverVersion=8&charset=utf8mb4" > .env.test.local
````

## Ajustar permisos
````
chmod -R 770 *
chown -R root:www-data *
````

## Crear base de datos para prod y dev y cargar datos iniciales
````
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load -e dev
````

## Crear base de datos para test y cargar datos iniciales
````
php bin/console doctrine:database:create -e test
php bin/console doctrine:schema:update --force -e test
php bin/console doctrine:fixtures:load -e test
````

## Configurar apache

Archivo de configuracion para virtual host Apache, adaptar las variables definidas según servidor
```
<VirtualHost *:80>
    Define SERVER  marcablanca.localtest.me
    Define PROJECT marcablanca
    Define PATH  C:/laragon/www/${PROJECT}
    Define PATHERROR  logs/

    DocumentRoot "${PATH}/public"
    ServerName ${SERVER}
	ServerAlias www.conejox.com www.babosas.com www.cerdas.com
    ErrorLog "${PATHERROR}/${PROJECT}-error.log"
    CustomLog "${PATHERROR}/${PROJECT}-access.log" common

    <Directory "${PATH}/public/">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
````

Reiniciar apache 
````
service apache2 reload
````

## Configurar los hosts del sistema para poder probar las webs
````
127.0.0.1 www.cerdas.com
127.0.0.1 www.babosas.com
127.0.0.1 www.conejox.com
````

## Configurar caches de webcams
Añadir a crontab el siguiente comando
````
crontab -e -u www-data
````
````
* * * * * php bin/console app:cache-all-webcams
````

## Lanzar test (esperar 1 minuto a que se ejecute CRON)
````
php bin/phpunit
````

## Pruebas desde el navegador
Puedes probar los dominios configurados en el host anteriormente



