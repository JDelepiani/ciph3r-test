# API de Gestión de Productos

Esta es una API RESTful desarrollada en **Laravel** que permite gestionar productos y sus precios en diferentes divisas. La API incluye operaciones CRUD (Crear, Leer, Actualizar, Eliminar) para productos, así como la capacidad de registrar precios en múltiples divisas.

---

## Requisitos Previos

Antes de comenzar, asegúrate de tener instalado lo siguiente en tu sistema:

- **PHP**: Versión 8.0 o superior.
- **Composer**: Gestor de dependencias para PHP.
- **Base de datos**: MySQL, PostgreSQL, SQLite, etc.
- **Node.js** y **npm**: Para compilar assets (si es necesario).

---

## Instalación

Sigue estos pasos para configurar el proyecto en tu entorno local:

1. **Clona el repositorio:**
   ```bash
   git clone https://github.com/JDelepiani/ciph3r-test.git
   cd ciph3r-test

2. **Instala las dependencias de PHP:**
    composer install

3. **Instala dependencias de javascript (opcional):**
    npm install

4. **Configura el archivo .env:**
    cp .env.example .env
    Configura las variables de entorno, como la conexión a la base de datos:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_de_tu_base_de_datos
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña

5. **Genera clave de API:**
    php artisan key:generate

6. **Ejecuta las migraciones:**
    php artisan migrate

7. **Si es necesario ejecuta los seeders de la base de datos:**
    php artisan db:seed

8. **Ejecuta el servidor de desarrollo:**
    php artisan serve

9. **Abre el navegador y accede a http://localhost:8000/api**

## Documentacion de la API

La documentación de la API está generada con Swagger. Puedes acceder a ella en:

http://localhost:8000/api/documentation

## Uso de la API

### Endpoints de la API

Productos:

- Obtener todos los productos: 
    `GET /api/products`

- Crear un producto:
    `POST /api/products`

    Cuerpo del request:
    ```json
    {
        "name": "Nombre del producto",
        "description": "Descripción del producto",
        "price": 10.00,
        "currency": "EUR",
        "image": "URL de la imagen del producto"
    }

- Obtener un producto:
    `GET /api/products/{id}`

- Actualizar un producto:
    `PUT /api/products/{id}`

    Cuerpo del request:
    ```json
    {
        "name": "Nombre actualizado",
        "description": "Descripción actualizada",
        "price": 150.00,
        "currency_id": 1,
        "tax_cost": 15.00,
        "manufacturing_cost": 60.00
    }

- Eliminar un producto:
    `DELETE /api/products/{id}`

Precios:

- Obtener todos los precios:
    `GET /api/products/{productId}/prices`

- Crear un precio:
    `POST /api/products/{productId}/prices`

    Cuerpo del request:
    ```json
    {
        "currency_id": 2,
        "price": 120.00
    }

