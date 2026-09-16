# LetsPlay - AEA5

Proyecto académico desarrollado con Laravel para la gestión de un catálogo de videojuegos mediante una aplicación web y una API REST.

---

## Descripción

**LetsPlay** es una aplicación web que permite consultar y gestionar un catálogo de videojuegos, además de disponer de un sistema de carrito de compra para los usuarios registrados.

La aplicación permite trabajar con videojuegos almacenados en una base de datos, gestionar su información mediante operaciones CRUD y realizar acciones como añadir videojuegos al carrito, modificar cantidades, eliminarlos y completar el proceso de compra.

Además de la parte web, el proyecto dispone de una **API REST** para consultar y gestionar los videojuegos mediante peticiones HTTP.

---

## Funcionalidades principales

* Registro de usuarios
* Inicio y cierre de sesión
* Acceso diferenciado para usuarios autenticados
* Visualización del catálogo de videojuegos
* Consulta de información de videojuegos
* Creación de videojuegos
* Edición de videojuegos
* Eliminación de videojuegos
* Eliminación de todos los videojuegos mediante la API
* Sistema de carrito de compra
* Añadir videojuegos al carrito
* Control del stock disponible
* Modificación de cantidades del carrito
* Eliminación de productos del carrito
* Página de pago
* Procesamiento de la compra
* API REST para la gestión de videojuegos
* Respuestas de la API en formato JSON

---

## Estructura del proyecto

```text
LetsPlay_laravel_AEA5_APIs/

|-- app/
|   |-- Http/
|   |   |-- Controllers/
|   |   |   |-- VideojuegoController.php
|   |   |   |-- CarritoController.php
|   |
|   |-- Models/
|       |-- Videojuego.php
|       |-- Carrito.php
|       |-- User.php
|
|-- bootstrap/
|
|-- config/
|
|-- database/
|   |-- migrations/
|   |-- seeders/
|   |-- factories/
|
|-- letsPlay-ProyectoLaravelBootsrap-AD/
|
|-- public/
|
|-- resources/
|   |-- views/
|   |-- css/
|   |-- js/
|
|-- routes/
|   |-- api.php
|   |-- web.php
|
|-- storage/
|
|-- tests/
|
|-- .env.example
|-- artisan
|-- composer.json
|-- package.json
|-- vite.config.js
|__ phpunit.xml
```

---

## Usuarios

La aplicación dispone de un sistema de autenticación mediante Laravel.

### Usuario no autenticado

Al entrar en la aplicación se muestra la página de bienvenida.

Desde la aplicación se puede acceder al sistema de autenticación para:

* Registrarse
* Iniciar sesión
* Cerrar sesión

Las rutas de autenticación se gestionan mediante `Auth::routes()`.

### Usuario autenticado

Una vez iniciado sesión, el usuario puede acceder a la página de bienvenida para usuarios registrados y utilizar las funcionalidades relacionadas con el carrito.

La ruta `/welcomeLogeado` requiere autenticación.

---

## Catálogo de videojuegos

Los videojuegos son el recurso principal de la aplicación.

Cada videojuego contiene los siguientes datos:

| Campo               | Descripción                          |
| ------------------- | ------------------------------------ |
| `id`                | Identificador del videojuego         |
| `nombre`            | Nombre del videojuego                |
| `genero`            | Género del videojuego                |
| `plataforma`        | Plataforma en la que está disponible |
| `fecha_lanzamiento` | Fecha de lanzamiento                 |
| `precio`            | Precio del videojuego                |
| `stock`             | Unidades disponibles                 |
| `imagen_url`        | URL de la imagen del videojuego      |

Estos campos están definidos en el modelo `Videojuego` y pueden utilizarse para crear y actualizar videojuegos.

---

## Gestión de videojuegos

La aplicación permite realizar las operaciones principales de un CRUD sobre los videojuegos.

### Mostrar videojuegos

Se puede consultar el listado completo de videojuegos.

La aplicación obtiene todos los registros almacenados en la base de datos.

### Consultar un videojuego

Cada videojuego puede consultarse mediante su identificador.

Si el ID no existe, la API devuelve un error `404`.

### Crear videojuego

Se puede crear un videojuego proporcionando:

* Nombre
* Género
* Plataforma
* Fecha de lanzamiento
* Precio
* Stock
* Imagen

La creación devuelve el videojuego creado junto con el código HTTP `201`.

### Editar videojuego

Los datos de un videojuego existente pueden modificarse utilizando su ID.

Se pueden actualizar todos los datos principales del videojuego.

### Eliminar videojuego

También es posible eliminar un videojuego individual.

Si el videojuego existe, se elimina de la base de datos y se devuelve una respuesta indicando que la operación se ha realizado correctamente.

---

# API REST

La aplicación dispone de una API REST específica para gestionar los videojuegos.

Las rutas principales se encuentran en:

```text
routes/api.php
```

La API utiliza `apiResource`, por lo que dispone de las operaciones CRUD habituales.

## Endpoints

| Método      | Endpoint                     | Función                        |
| ----------- | ---------------------------- | ------------------------------ |
| `GET`       | `/api/videojuego`            | Obtener todos los videojuegos  |
| `GET`       | `/api/videojuego/{id}`       | Obtener un videojuego concreto |
| `POST`      | `/api/videojuego`            | Crear un videojuego            |
| `PUT/PATCH` | `/api/videojuego/{id}`       | Actualizar un videojuego       |
| `DELETE`    | `/api/videojuego/{id}`       | Eliminar un videojuego         |
| `DELETE`    | `/api/videojuego/delete/all` | Eliminar todos los videojuegos |

La ruta especial para eliminar todos los videojuegos utiliza `/delete/all` para evitar conflictos con la ruta utilizada para buscar videojuegos por ID.

---

## Ejemplo de creación mediante API

Para crear un videojuego se realiza una petición:

```http
POST /api/videojuego
```

Con los datos:

```json
{
    "nombre": "Minecraft",
    "genero": "Supervivencia",
    "plataforma": "PC",
    "fecha_lanzamiento": "2011-11-18",
    "precio": 29.99,
    "stock": 10,
    "imagen_url": "https://ejemplo.com/minecraft.jpg"
}
```

La API crea el videojuego y devuelve sus datos en formato JSON.

---

## Ejemplo de respuesta

Una respuesta de la API puede tener una estructura similar a:

```json
{
    "id": 1,
    "nombre": "Minecraft",
    "genero": "Supervivencia",
    "plataforma": "PC",
    "fecha_lanzamiento": "2011-11-18",
    "precio": 29.99,
    "stock": 10,
    "imagen_url": "https://ejemplo.com/minecraft.jpg"
}
```

---

# Carrito de compra

El carrito está disponible para los usuarios autenticados.

Cada elemento del carrito está relacionado con:

* Un usuario
* Un videojuego
* Una cantidad

El modelo `Carrito` mantiene relaciones con los modelos `User` y `Videojuego` mediante relaciones de Eloquent.

---

## Añadir al carrito

Desde el catálogo se puede añadir un videojuego al carrito.

Al pulsar el botón correspondiente:

1. Se comprueba que exista stock.
2. Se comprueba si el videojuego ya está en el carrito.
3. Si ya existe, aumenta su cantidad.
4. Si no existe, se crea un nuevo elemento.
5. Se descuenta una unidad del stock disponible.

Por lo tanto, el stock se actualiza automáticamente al añadir productos.

Si el videojuego no tiene stock disponible, no se puede añadir al carrito.

---

## Ver carrito

El usuario puede acceder a:

```text
/carrito
```

Esta página muestra los videojuegos que tiene actualmente en su carrito junto con sus cantidades.

La información se obtiene únicamente para el usuario que ha iniciado sesión.

---

## Modificar cantidad

El usuario puede modificar la cantidad de un videojuego que tenga en el carrito.

La cantidad debe:

* Ser un número entero
* Ser como mínimo `1`
* No superar el stock disponible

Si se intenta superar el stock permitido, se muestra un mensaje indicando:

```text
Stock máximo alcanzado
```

Si la modificación es correcta:

```text
Cantidad actualizada correctamente
```

---

## Eliminar del carrito

El usuario puede eliminar un videojuego del carrito.

Al eliminarlo:

1. Se obtiene el videojuego asociado.
2. Se devuelve al stock la cantidad que estaba reservada.
3. Se elimina el elemento del carrito.
4. Se muestra un mensaje de confirmación.

Mensaje mostrado:

```text
Videojuego eliminado del carrito.
```

---

# Proceso de compra

Una vez que el usuario tiene videojuegos en el carrito puede acceder a la página de pago.

La ruta utilizada es:

```text
/carrito/pagar
```

Desde esta página se puede iniciar el proceso de compra.

Al procesar el pago:

1. Se obtienen los productos del carrito del usuario.
2. Se recorren los elementos del carrito.
3. Se eliminan los productos del carrito.
4. Se muestra un mensaje confirmando que el pago se ha realizado.

Mensaje mostrado:

```text
Pago realizado correctamente!
```

---

# Botones y acciones de la aplicación

La aplicación dispone de diferentes acciones dependiendo de la página y del estado de autenticación.

| Botón / Acción         | Función                               |
| ---------------------- | ------------------------------------- |
| `Registrarse`          | Crear una nueva cuenta                |
| `Iniciar sesión`       | Acceder con un usuario existente      |
| `Cerrar sesión`        | Finalizar la sesión                   |
| `Ver videojuegos`      | Consultar el catálogo                 |
| `Crear videojuego`     | Añadir un nuevo videojuego            |
| `Editar`               | Modificar los datos de un videojuego  |
| `Eliminar`             | Eliminar un videojuego                |
| `Añadir al carrito`    | Añadir una unidad al carrito          |
| `Carrito`              | Consultar los productos seleccionados |
| `Actualizar`           | Modificar la cantidad de un producto  |
| `Eliminar del carrito` | Quitar un producto del carrito        |
| `Pagar`                | Acceder al proceso de pago            |
| `Procesar pago`        | Finalizar la compra                   |

Las acciones relacionadas con el carrito están protegidas mediante middleware de autenticación.

---

# Control del stock

El stock está conectado directamente con el funcionamiento del carrito.

### Al añadir un producto

```text
Stock disponible
       ↓
Añadir al carrito
       ↓
Stock - 1
```

### Al eliminar un producto del carrito

```text
Producto en carrito
       ↓
Eliminar
       ↓
Stock + cantidad eliminada
```

De esta forma se intenta mantener actualizado el número de unidades disponibles.

---

# Estructura de los modelos

## Videojuego

El modelo `Videojuego` representa cada producto disponible en la aplicación.

Sus atributos principales son:

```text
nombre
genero
plataforma
fecha_lanzamiento
precio
stock
imagen_url
```

## Carrito

El modelo `Carrito` almacena los productos asociados a cada usuario.

```text
user_id
videojuego_id
cantidad
```

Además, mantiene dos relaciones:

```text
Carrito → Videojuego
Carrito → User
```

---

# Estructura de rutas

## Rutas web

Las rutas web gestionan la parte visual de la aplicación:

```text
/
```

Página principal.

```text
/welcomeLogeado
```

Página de bienvenida para usuarios autenticados.

```text
/videojuego
```

Gestión CRUD de videojuegos.

```text
/carrito
```

Visualización del carrito.

```text
/carrito/add/{videojuego}
```

Añadir un videojuego.

```text
/carrito/update/{carrito}
```

Actualizar la cantidad.

```text
/carrito/remove/{carrito}
```

Eliminar un producto.

```text
/carrito/pagar
```

Página de pago.

```text
/pago/procesar
```

Procesamiento del pago.

---

# Estructura de la API

Las rutas de la API están definidas en:

```text
routes/api.php
```

El controlador principal de la API es:

```text
VideojuegoController
```

Sus métodos principales son:

```text
index()
show()
store()
update()
destroy()
deleteAll()
```

Estos métodos permiten realizar las operaciones de consulta, creación, modificación y eliminación de videojuegos.

---

# Postman

El proyecto incluye una configuración de **Postman** para probar las diferentes peticiones de la API.

```text
.postman/
postman/
```

Desde Postman se pueden probar las operaciones CRUD disponibles para los videojuegos.

Ejemplos:

```text
GET
POST
PUT / PATCH
DELETE
```

También se puede probar la eliminación de todos los videojuegos mediante:

```text
DELETE /api/videojuego/delete/all
```

---

# Instalación

## 1. Clonar el repositorio

```bash
git clone https://github.com/TheIza/LetsPlay_laravel_AEA5_APIs.git
cd LetsPlay_laravel_AEA5_APIs
```

## 2. Instalar las dependencias de PHP

```bash
composer install
```

## 3. Crear el archivo `.env`

```bash
cp .env.example .env
```

## 4. Generar la clave de Laravel

```bash
php artisan key:generate
```

## 5. Configurar la base de datos

Configurar en `.env` los datos correspondientes a la base de datos:

```env
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

## 6. Ejecutar las migraciones

```bash
php artisan migrate
```

Si el proyecto dispone de seeders:

```bash
php artisan db:seed
```

## 7. Instalar las dependencias de JavaScript

```bash
npm install
```

## 8. Ejecutar Vite

Durante el desarrollo:

```bash
npm run dev
```

## 9. Iniciar Laravel

En otra terminal:

```bash
php artisan serve
```

La aplicación estará disponible normalmente en:

```text
http://127.0.0.1:8000
```

---

# Ejecución rápida

Laravel también incluye scripts para facilitar la configuración inicial.

Después de instalar las dependencias se puede utilizar:

```bash
composer run setup
```

Este comando realiza automáticamente varias tareas de configuración, entre ellas:

* Instalar dependencias
* Crear `.env` si no existe
* Generar la clave de Laravel
* Ejecutar las migraciones
* Instalar dependencias de NPM
* Compilar los recursos frontend

Para trabajar en modo desarrollo se dispone también de:

```bash
composer run dev
```

Este comando ejecuta simultáneamente el servidor de Laravel, la cola, los logs y Vite.

---

# Pruebas

Para ejecutar las pruebas del proyecto:

```bash
php artisan test
```

También existe el script:

```bash
composer test
```

que ejecuta las pruebas de Laravel después de limpiar la configuración.

---

# Tecnologías

* PHP 8.2+
* Laravel 12
* Laravel Sanctum
* Laravel UI
* Eloquent ORM
* MySQL / SQLite
* API REST
* JSON
* Composer
* NPM
* Vite
* Bootstrap
* Tailwind CSS
* Sass
* Axios
* PHPUnit
* Postman

Las dependencias principales del proyecto están definidas en `composer.json` y `package.json`.

---

# Arquitectura

El proyecto utiliza la estructura habitual de Laravel, separando las diferentes responsabilidades:

```text
Rutas
  ↓
Controllers
  ↓
Models
  ↓
Base de datos
```

Para la parte web:

```text
Usuario
   ↓
Vista Blade
   ↓
Ruta web
   ↓
Controller
   ↓
Modelo Eloquent
   ↓
Base de datos
```

Para la API:

```text
Cliente / Postman
        ↓
   API REST
        ↓
VideojuegoController
        ↓
     Eloquent
        ↓
   Base de datos
        ↓
     JSON
```

---

# API vs aplicación web

El proyecto permite trabajar con los videojuegos desde dos partes diferentes.

| Aplicación web      | API REST                 |
| ------------------- | ------------------------ |
| Interfaz gráfica    | Peticiones HTTP          |
| Vistas Blade        | Respuestas JSON          |
| CRUD de videojuegos | CRUD de videojuegos      |
| Carrito             | Gestión de videojuegos   |
| Sistema de usuarios | Endpoints API            |
| Proceso de compra   | Pruebas mediante Postman |

La API está enfocada principalmente a la gestión de los videojuegos, mientras que la aplicación web añade las funcionalidades de usuario y carrito.

---

# Resumen del funcionamiento

```text
                    LETSPLAY
                       │
             ┌─────────┴─────────┐
             │                   │
       Aplicación Web          API REST
             │                   │
       ┌─────┴─────┐        Videojuegos
       │           │
   Usuarios    Videojuegos
                   │
                Carrito
                   │
                 Pago
```

El usuario puede registrarse o iniciar sesión, consultar el catálogo de videojuegos y, si está autenticado, añadir productos al carrito. El stock se actualiza al añadir o eliminar productos y finalmente el usuario puede acceder al proceso de pago.

Por otra parte, los videojuegos pueden gestionarse mediante la API REST utilizando operaciones `GET`, `POST`, `PUT/PATCH` y `DELETE`.

---

## Créditos

Proyecto académico **AEA5 - LetsPlay**.

Desarrollado como proyecto de Laravel para trabajar con:

* Aplicaciones web
* APIs REST
* CRUD
* Bases de datos
* Autenticación
* Relaciones entre modelos
* Carritos de compra
* Gestión de stock
