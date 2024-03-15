# challenge-abitmedia-app

Powered by:

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

`Laravel version: 11`

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

y también

```BASH
php artisan passport:client --personal
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

_`Se sugiere utilizar el comando php artisan migrate --seed para tener informacion en la base de datos`_

## API

Para levantar el api, se debe ejecutar el comado:

```BASH
php artisan serve
```

La ruta la verás en la terminal, similar a:

![badge](https://img.shields.io/badge/INFO-blue?style=flat-square) Server running on [http://127.0.0.1:8000].

### AUTENTICACIÓN

#### LOGIN

Endpoint: `/api/auth/login`

**Descripción**

Esta ruta permite obtener un token de autenticación del usuario para poder realizar peticiones a rutas seguras.

_**Parámetros:**_

```JSON
{
    "email": "test@email.com", // Email del usuario
    "password" "password" // Contraseña del usuario
}
```

```cURL
curl --location 'http://localhost:8000/api/auth/login' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--data-raw '{
    "email": "test@email.com",
    "password": "password"
}'
```

**Response**

```JSON
{
    "success": true,
    "message": "Login Success",
    "data": {
        "user": {
            "name": "Test User",
            "email": "test@email.com"
        },
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5YjkxMzNlZC0xMjE1LTQ0NzUtYTFlMS0yYzllYmUwYWE0OTUiLCJqdGkiOiIzOGY5OTVjMGRlODViM2EyNzdjZWI4YWU5ZDU3OThiNGU5NjM3MGRhYWVjZWFmYWVlMGM5OTYxYTAwM2JmZjZlZTMxYzhlNjQ1Nzc2NjE2MCIsImlhdCI6MTcxMDQ3OTc3Mi45NDM4LCJuYmYiOjE3MTA0Nzk3NzIuOTQzODEsImV4cCI6MTc0MjAxNTc3Mi45MjMyNTgsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.RZMveNY4QdWsrAOwzGqoFmkclGABx0oI_mvYOYohzxlnMlvZ0YkfbppZ0A9lBDP0aocGmDmzTaqjExd6okbyk9Pckr9fXnxGYD8dMnsghQXqMuUFzCogdvSy_qxuIJSOw8GVhtdVxsCaam0DVVy3F4lscMV4Xt3dcrTc9jZTGjENec8ZNcY1xs7lpJf2e4sUYhk-LIEc5FkaLr5psn4w_C9HoaGYu-BVJ7lV4Enb3w0yYj-J5dYUUsMh9pBJav2Y2wR_Y4XVyM6iiXF6Br3VH6V7-rmgvksaqyi7oEZLSsaNZjurjCyrGS9alDsP1o12jt65uLt3fvNjcaNLb2xvJLnh9zh1TUplveQtX58qKihLHEZuxm0JhhNUtOV-wHCJ_hRNQFvyEeQeB5wEYKycNLe4S5UY9s8pkRX6p9aw0Duu_KPZByBhFB7oKpBjw66ghZGReLoPCb81ouIQoL20y2qXPCNh9QsBGhIbcWqnjsZ_ipO6qqVVHtE_bzjohi4-0S1ZlNwWnQ11ZLRfiOowMFlsn1BIlIxWofy4R-wq2hvg6AhiVNmQ-7Qar1VF3VZI3PeXEVTCmc3HAAv18tawronjOwS9nT4Y9KPvME26dMfcBOw5Bv32GYce5C5cZHVaSlvfu2OOSHq-FNtkH0qbliU7teQ0aflvWcSocig7OMs"
    }
}
```

`El token se utilizará en proximas peticiones`
