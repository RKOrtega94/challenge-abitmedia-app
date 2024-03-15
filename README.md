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
php artisan migrate:fresh
```

_`Se sugiere utilizar el comando php artisan migrate --seed para tener informacion en la base de datos`_

**_Nota_**: Si al hacer pruebas da error al generar el token, se debe ejecutar el comando `php artisan passport:client --personal` para solucionarlo.

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

### API DE SERVICIOS

#### GET ALL

Endpoint: `/api/services`

```cURL
curl --location 'http://localhost:8000/api/services' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer {{ AUTH_TOKEN }}'
```

Respuesta:

```JSON
{
    "success": true,
    "message": "Services retrieved successfully",
    "data": [
        {
            "id": 1,
            "sku": "23c4516e4e",
            "name": "Formateo de computadores",
            "description": "Formateo de computadores",
            "price": "25.00",
            "created_at": "2024-03-15T20:06:44.000000Z",
            "updated_at": "2024-03-15T20:06:44.000000Z"
        },
        {
            "id": 2,
            "sku": "9dbd177487",
            "name": "Mantenimiento",
            "description": "Mantenimiento de computadores",
            "price": "30.00",
            "created_at": "2024-03-15T20:06:44.000000Z",
            "updated_at": "2024-03-15T20:06:44.000000Z"
        },
        {
            "id": 3,
            "sku": "d464ec5b23",
            "name": "Hora de soporte en software",
            "description": "Hora de soporte en software",
            "price": "50.00",
            "created_at": "2024-03-15T20:06:44.000000Z",
            "updated_at": "2024-03-15T20:06:44.000000Z"
        }
    ]
}
```

Se puede utilizar `query params` para filtrar los datos:

Ejemplo: `/api/services?name=soporte`

```cURL
curl --location 'http://localhost:8000/api/services?name=soporte' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer {{ AUTH_TOKEN }}'
```

Respuesta:

```JSON
{
    "success": true,
    "message": "Services retrieved successfully",
    "data": [
        {
            "id": 3,
            "sku": "d464ec5b23",
            "name": "Hora de soporte en software",
            "description": "Hora de soporte en software",
            "price": "50.00",
            "created_at": "2024-03-15T20:06:44.000000Z",
            "updated_at": "2024-03-15T20:06:44.000000Z"
        }
    ]
}
```

#### GET BY ID

Endpoint: `/api/services/{id}`

```cURL
curl --location 'http://localhost:8000/api/services/1' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer {{ AUTH_TOKEN }}'
```

Respuesta:

```JSON
{
    "success": true,
    "message": "Service retrieved successfully",
    "data": {
        "id": 1,
        "sku": "23c4516e4e",
        "name": "Formateo de computadores",
        "description": "Formateo de computadores",
        "price": "25.00",
        "created_at": "2024-03-15T20:06:44.000000Z",
        "updated_at": "2024-03-15T20:06:44.000000Z"
    }
}
```

#### CREATE

Endpoint: `/api/services`

```cULR
curl --location 'http://localhost:8000/api/services' \
--header 'Authorization: Bearer {{ AUTH_TOKEN }}' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "sku": "abcd123459",
    "name": "Mantenimiento de impresoras",
    "description": "Servicio de mantenimiento de impresoras",
    "price": 15
}'
```

Respuesta:

```JSON
{
    "success": true,
    "message": "Service created successfully",
    "data": {
        "sku": "abcd123459",
        "name": "Mantenimiento de impresoras",
        "description": "Servicio de mantenimiento de impresoras",
        "price": 15,
        "updated_at": "2024-03-15T21:44:20.000000Z",
        "created_at": "2024-03-15T21:44:20.000000Z",
        "id": 5
    }
}
```

#### UPDATE

Endpoint: `/api/services/{id}`

```cURL
curl --location --request PUT 'http://localhost:8000/api/services/5' \
--header 'Authorization: Bearer {{ AUTH_TOKEN }}' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "sku": "abcd123459",
    "name": "Servicio de mantenimiento de impresoras térmicas",
    "description": "Servicio de mantenimiento de impresoras termicas.",
    "price": 35
}'
```

Respuesta:

```JSON
{
    "success": true,
    "message": "Service updated successfully",
    "data": {
        "id": 5,
        "sku": "abcd123459",
        "name": "Servicio de mantenimiento de impresoras térmicas",
        "description": "Servicio de mantenimiento de impresoras termicas.",
        "price": 35,
        "created_at": "2024-03-15T21:44:20.000000Z",
        "updated_at": "2024-03-15T21:48:58.000000Z"
    }
}
```

#### DELETE

```cURL
curl --location --request DELETE 'http://localhost:8000/api/services/5' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer {{ AUTH_TOKEN }}'
```

Respuesta:

```JSON
{
    "success": true,
    "message": "Service deleted successfully",
    "data": []
}
```

### API DE PRODUCTOS

#### GET ALL

Endpoint: `/api/products`

```cURL
curl --location 'http://localhost:8000/api/products' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer {{ AUTH_TOKEN }}'
```

Respuesta:

```JSON
{
    "success": true,
    "message": "Products retrieved successfully",
    "data": [
        {
            "id": 1,
            "sku": "6fcf192a89",
            "name": "Antivirus",
            "description": "Antivirus software",
            "windows_price": "5.00",
            "mac_price": "7.00",
            "stock": {
                "windows": 10,
                "mac": 10
            }
        },
        {
            "id": 2,
            "sku": "5c590f425f",
            "name": "Ofimática",
            "description": "Software de ofimática",
            "windows_price": "10.00",
            "mac_price": "12.00",
            "stock": {
                "windows": 20,
                "mac": 20
            }
        },
        {
            "id": 3,
            "sku": "b3bf051aa1",
            "name": "Editor de video",
            "description": "Software de edición de video",
            "windows_price": "20.00",
            "mac_price": "22.00",
            "stock": {
                "windows": 30,
                "mac": 30
            }
        }
    ]
}
```

Se puede utilizar `query params` para filtrar los datos:

Ejemplo: `/api/products?name=soporte`

```cURL
curl --location 'http://localhost:8000/api/products?name=antivirus' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer {{ AUTH_TOKEN }}'
```

Respuesta:

```JSON
{
    "success": true,
    "message": "Products retrieved successfully",
    "data": [
        {
            "id": 1,
            "sku": "6fcf192a89",
            "name": "Antivirus",
            "description": "Antivirus software",
            "windows_price": "5.00",
            "mac_price": "7.00",
            "stock": {
                "windows": 10,
                "mac": 10
            }
        }
    ]
}
```

#### GET BY ID

Endpoint: `/api/products/{id}`

```cURL
curl --location 'http://localhost:8000/api/products/1' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer {{ AUTH_TOKEN }}'
```

Respuesta:

```JSON
{
    "success": true,
    "message": "Product retrieved successfully",
    "data": {
        "id": 1,
        "sku": "6fcf192a89",
        "name": "Antivirus",
        "description": "Antivirus software",
        "windows_price": "5.00",
        "mac_price": "7.00",
        "stock": {
            "windows": 10,
            "mac": 10
        }
    }
}
```

#### CREATE

Endpoint: `/api/products`

```cURL
curl --location 'http://localhost:8000/api/products' \
--header 'Authorization: Bearer {{ AUTH_TOKEN }}' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "sku": "abcd678901",
    "name": "Edición de fotografía",
    "description": "Software de edición de fotografía",
    "windows_price": 35,
    "mac_price": 40
}'
```

Respuesta:

```JSON
{
    "success": true,
    "message": "Product created successfully",
    "data": {
        "sku": "abcd678901",
        "name": "Edición de fotografía",
        "description": "Software de edición de fotografía",
        "windows_price": 35,
        "mac_price": 40,
        "updated_at": "2024-03-15T22:07:22.000000Z",
        "created_at": "2024-03-15T22:07:22.000000Z",
        "id": 4
    }
}
```

#### UPDATE

Endpoint: `/api/products/{id}`

```cURL
curl --location --request PUT 'http://localhost:8000/api/products/4' \
--header 'Authorization: Bearer {{ AUTH_TOKEN }}' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "sku": "abcd123458",
    "name": "Adobe Ilustrator",
    "description": "Software de edición de fotografía",
    "windows_price": 40,
    "mac_price": 45
}'
```

```JSON
{
    "success": true,
    "message": "Product updated successfully",
    "data": {
        "id": 4,
        "sku": "abcd123458",
        "name": "Adobe Ilustrator",
        "description": "Software de edición de fotografía",
        "windows_price": 40,
        "mac_price": 45,
        "created_at": "2024-03-15T22:07:22.000000Z",
        "updated_at": "2024-03-15T22:11:04.000000Z"
    }
}
```

#### DELETE

Endpoint: `/api/products/{id}`

```cURL
curl --location --request DELETE 'http://localhost:8000/api/products/4' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer {{ AUTH_TOKEN }}'
```

Response:

```JSON
{
    "success": true,
    "message": "Product deleted successfully",
    "data": []
}
```

### API DE LICENCCIAS

#### GET ALL

Endpoint: `/api/licenses`

```cURL
curl --location 'http://localhost:8000/api/licenses' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer {{ AUTH_TOKEN }}'
```

Response:

```JSON
{
    "success": true,
    "message": "Licenses retrieved successfully",
    "data": [
        {
            "product": "Antivirus",
            "serial": "a587bbdd370ed7077ab5af4adc9fd079aa129241fd0caa8caf53da3fb91a39ff1d3a398fda1a06e1b4ce11605dbeb8672c49",
            "platform": "windows",
            "status": "sold",
            "price": "5.00"
        },
        {
            "product": "Antivirus",
            "serial": "30a2a9ca4f783127d52f040939cf5ea3411280743d850702b26d513b6f53b17c5c28f2f277c5317cf2ce149084d7fc92287a",
            "platform": "windows",
            "status": "active",
            "price": "5.00"
        },
        {
            "product": "Antivirus",
            "serial": "6c9732126df7818c26fb31025d7891aeb79e41c94e63e6ff5cfbb15179b80adb9fdf6a2589281642fcf88777ca37e8765c6f",
            "platform": "windows",
            "status": "active",
            "price": "5.00"
        },
        {
            "product": "Antivirus",
            "serial": "983748d7be6a0af1aa40ff2bd3626efd27381a9e473d9a81defba37b03da262580cc07de6a55a0067a0837785f7af0dcf61c",
            "platform": "windows",
            "status": "active",
            "price": "5.00"
        },
        {
            "product": "Antivirus",
            "serial": "868db0afd57e808fb2e59b4f0db23f704065451c1e5678857e55d855035d1ac6ac8b516b025e2e9cb74157282855aed92db2",
            "platform": "windows",
            "status": "active",
            "price": "5.00"
        },
        {
            "product": "Editor de video",
            "serial": "96346e67bb6026737bc0dd6623bd7948c80b851e8bc0a464d1d84d52986ba4fe4e5448ab31ca8597366b2176788bde54067c",
            "platform": "mac",
            "status": "active",
            "price": "22.00"
        }
    ]
}
```

Se puede utilizar `query params` para filtrar los datos:

Ejemplo `/api/licenses?product=antivirus`

```cURL
curl --location 'http://localhost:8000/api/licenses?platform=mac' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer {{ AUTH_TOKEN }}'
```

```JSON
{
    "success": true,
    "message": "Licenses retrieved successfully",
    "data": [
        {
            "product": "Editor de video",
            "serial": "96346e67bb6026737bc0dd6623bd7948c80b851e8bc0a464d1d84d52986ba4fe4e5448ab31ca8597366b2176788bde54067c",
            "platform": "mac",
            "status": "active",
            "price": "22.00"
        }
    ]
}
```

#### GET BY ID

Endpoint: `/api/licenses/{id}`

```cURL
curl --location 'http://localhost:8000/api/licenses/1' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer {{ AUTH_TOKEN }}'
```

Response:

```JSON
{
    "success": true,
    "message": "License retrieved successfully",
    "data": {
        "product": "Antivirus",
        "serial": "a587bbdd370ed7077ab5af4adc9fd079aa129241fd0caa8caf53da3fb91a39ff1d3a398fda1a06e1b4ce11605dbeb8672c49",
        "platform": "windows",
        "status": "sold",
        "price": "5.00"
    }
}
```

#### CREATE

Endpoint: `/api/licenses`

```cURL
curl --location 'http://localhost:8000/api/licenses' \
--header 'Authorization: Bearer {{ AUTH_TOKEN }}' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "product_id": 1,
    "platform": "windows"
}'
```

Response:

``JSON

```
{
    "success": true,
    "message": "License created successfully",
    "data": {
        "product": "Antivirus",
        "serial": "436d84590f9e82342cbc091ebc6393c90bf211778880af5e369325af11f2f9e32097bf8b6eed298554174b26a5720ee9fae8",
        "platform": "windows",
        "status": "active",
        "price": "5.00"
    }
}
```

**_El serial se genera automáticamente._**

#### UPDATE

Endpoint: `/api/licenses/{id}`

```cURL
curl --location --request PUT 'http://localhost:8000/api/licenses/4' \
--header 'Authorization: Bearer {{ AUTH_TOKEN }}' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "status": "sold"
}'
```

Response:

```JSON
{
    "success": true,
    "message": "License updated successfully",
    "data": {
        "product": "Antivirus",
        "serial": "983748d7be6a0af1aa40ff2bd3626efd27381a9e473d9a81defba37b03da262580cc07de6a55a0067a0837785f7af0dcf61c",
        "platform": "windows",
        "status": "sold",
        "price": "5.00"
    }
}
```

#### DELETE

Endpoint: Endpoint: `/api/licenses/{id}`

```cURL
curl --location --request DELETE 'http://localhost:8000/api/licenses/4' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer {{ AUTH_TOKEN }}'
```

Response:

```JSON
{
    "success": true,
    "message": "License deleted successfully",
    "data": []
}
```

## CONFIGURACION DE POSTMAN (TESTING)

https://www.postman.com/lunar-trinity-627143/workspace/challenge-abitmedia-app

Para utilizar postman es necesatio instalarlo https://www.postman.com/downloads/

Para hacer consultas a las rutas protegidas se debe ejecutar primero el endpoint `login` para obtener el token y reemplazarlo en las variables de las colecciones.
