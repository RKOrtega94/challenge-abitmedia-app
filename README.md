# challenge-abitmedia-app

Powered by:

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Instalación

1. Clonar/descargar el proyecto.

```BASH
git clone https://github.com/RKOrtega94/challenge-abitmedia-app.git
```

2. Generar el key del proyecto

```BASH
php artisan key:generate
```

3. Configurar passport (_`El proyecto utiliza passport para la autenticación de usuarios`_)

```BASH
php artisan passport:keys
```

4. Configurar archivo .env

    4.1. Copiar archivo .env.example

    ```BASH
    cp .env.example .env
    ```

    4.2. Reemplazar variables de entorno

    ```env
    DB_CONNECTION=YOUR_DB_DRIVER
    DB_HOST=YOUR_DB_HOST
    DB_PORT=YOUR_DB_PORT
    DB_DATABASE=YOUR_DB_DATABASE_NAME
    DB_USERNAME=YOUR_DB_USER
    DB_PASSWORD=YOUR_DB_PASSWORD
    ```

5. Iniciar la migracion de la base de datos

`Se puede ejecutar solo las migraciones`

```BASH
php artisan migrate
```

`O se puede ejecutar con los semilleros`

```BASH
php artisan migrate --seed
```

`Si se requiere limpiar la base de datos y ejecutar las migraciones.` _`se puede agregar --seed para ejectar el semillero`_

```BASH
php artisab migrate:fresh
```
