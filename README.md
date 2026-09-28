# Apuntes del entorno local

# Encontramos el volumen de nuestro entorno y lo borramos con 
docker volume rm <nombre_volume>

# Rehacemos
docker compose build mysql

# Relanzamos
docker compose up -d

---

# Readme proyecto original

Instala rápidamente un ambiente de desarrollo local para trabajar con [PHP](https://www.php.net/) y [MySQL](https://www.mysql.com/) utilizando [Docker](https://www.docker.com). 

Utilizar *Docker* es sencillo, pero existen tantas imágenes, versiones y formas para crear los contenedores que hacen tediosa esta tarea. Este proyecto ofrece una instalación rápida, con versiones estandar y con la mínima cantidad de modificaciones a las imágenes de Docker. 

Viene configurado con  `PHP 8.0` y `MySQL LTS`, además se incluyen las extensiones `gd`, `zip` y `mysql`.

## Configurar el ambiente de desarrollo

Puedes utilizar la configuración por defecto, pero en ocasiones es recomendable modificar la configuración para que sea igual al servidor de producción. La configuración se ubica en el archivo `.env` con las siguientes opciones:

- `PHP_VERSION` versión de PHP ([Versiones disponibles de PHP](https://github.com/docker-library/docs/blob/master/php/README.md#supported-tags-and-respective-dockerfile-links)).

- `DOCUMENT_ROOT` define la ruta en la que pondremos la raíz de nuestro site. Por defecto es `./www/public`

- `PHP_PORT` puerto para servidor web. Por defecto se ha puesto 8080.

- `MYSQL_VERSION` versión de MySQL([Versiones disponibles de MySQL](https://hub.docker.com/_/mysql)).

- `MYSQL_USER` nombre de usuario para conectarse a MySQL.

- `MYSQL_PASSWORD` clave de acceso para conectarse a MySQL.

- `MYSQL_DATABASE` nombre de la base de datos que se crea por defecto.

## Instalar el ambiente de desarrollo

La instalación se hace en línea de comandos:

```zsh
docker-compose up -d
