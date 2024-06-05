<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
    </a>
</p>

## Sobre el Proyecto

Este proyecto es una plataforma de comparación de coches que ofrece fichas técnicas detalladas y análisis exhaustivos de precios, características y rendimiento de una amplia gama de vehículos. Proporciona a los usuarios información relevante para tomar decisiones informadas al comprar un coche nuevo o usado. Incluye comparaciones de tecnología, seguridad, diseño, opiniones de expertos y más.

## Tecnologías Utilizadas

- Laravel 11.x
- Vue.js 5.x
- Bootstrap 5.x
- Toastr.js

## Características Principales

- Motor de enrutamiento simple y rápido.
- Contenedor de inyección de dependencias poderoso.
- Múltiples back-ends para almacenamiento de sesiones y caché.
- ORM de base de datos intuitivo y expresivo.
- Migraciones de esquemas de bases de datos independientes.
- Procesamiento robusto de trabajos en segundo plano.
- Transmisión de eventos en tiempo real.
- ApiREST

## Requisitos del Sistema

- PHP >= 7.4
- Composer
- Node.js & npm
- MySQL

## Instalación

### Clonar el Repositorio

```bash
git clone https://github.com/sbo24/TFG-HIERODURO.git
cd laravel
```
## Instalar Dependencias
Una vez que hayas clonado el repositorio, instala las dependencias del proyecto utilizando Composer y npm:
```bash
composer install
npm install
```
## Configurar el Archivo de Entorno
Copia el archivo .env.example y créalo como .env. Después, configura las variables de entorno, como la conexión a la base de datos.
```bash
cp .env.example .env
```
## Ejecutar Migraciones y Semillas
Ejecuta las migraciones de la base de datos y las semillas para tener datos de ejemplo:
```bash
php artisan migrate --seed
```
## Compilar los Recursos Frontales
Compila los recursos frontales utilizando npm:
```bash
npm run dev
```
## Ejecutar el Servidor de Desarrollo
Finalmente, puedes ejecutar el servidor de desarrollo de Laravel para ver la aplicación en acción:
```bash
php artisan serve
```
## Después de ejecutar este comando, podrás acceder a la aplicación en tu navegador visitando http://localhost:8000.

¡Y eso es todo! Ahora deberías tener el proyecto de comparación de coches funcionando en tu máquina local.

## Licencia

Este proyecto está bajo la [Licencia MIT](LICENSE.txt).

