⚙️ Gestión de Taller Mecánico

Proyecto académico – Seminario de Software

El sistema Gestión de Taller Mecánico es una aplicación web desarrollada con Laravel que busca optimizar la administración de talleres automotrices.
Entre sus principales objetivos está digitalizar los procesos manuales de registro, diagnóstico, reparación y entrega de vehículos, brindando una plataforma moderna, segura y fácil de usar tanto para empleados como para clientes.

🚗 Descripción del Proyecto

Este proyecto surge de la necesidad de mejorar la organización interna de los talleres mecánicos, donde muchas veces los registros se llevan en papel o de forma desordenada.
Con nuestro sistema, buscamos:

📋 Registrar órdenes de trabajo (vehículo, cliente, mecánico asignado y estado del servicio).

🔧 Gestionar servicios y repuestos, con sus respectivos precios y disponibilidad.

👨‍🔧 Asignar tareas al personal técnico y controlar el progreso de cada reparación.

💰 Generar cotizaciones y facturas automáticamente.

📊 Visualizar reportes de rendimiento, ingresos y carga laboral.

Todo esto bajo un entorno desarrollado con Laravel, PHP 8, MariaDB y Docker, asegurando portabilidad, escalabilidad y fácil mantenimiento.

🧠 Objetivo General

Diseñar e implementar un sistema web que automatice la gestión administrativa y operativa de un taller mecánico, permitiendo un mejor control sobre los servicios ofrecidos, los clientes y los empleados.

🛠️ Tecnologías Utilizadas

Framework: Laravel 12

Lenguaje: PHP 8.2

Base de datos: MariaDB

Contenedores: Docker

Entorno de desarrollo: Visual Studio Code + Dev Containers

Control de versiones: Git y GitHub

💡 Características Destacadas

Sistema modular basado en arquitectura MVC.

Integración de autenticación de usuarios (administradores, técnicos y clientes).

Panel administrativo para la gestión de servicios, productos y personal.

Funcionalidad para control de citas y seguimiento de reparaciones.

Interfaz limpia, moderna y responsive.

👨‍💻 Integrantes del Grupo 3<br>
Nombre Completo	Número de Cuenta<br>
Yeferson Alexander López Umanzor	0801200221402<br>
Sayd Josue Rodriguez Merlo	0801200320730<br>
Krizia Lidenis Cruz Rodriguez	0101200400076<br>
Dixie Dariela Giron Flores	0318200401335<br>
Brayan Adalid Cruz Osorio	1503199500704<br>

🚀 Cómo Ejecutarlo

1️⃣ Clonar el repositorio

git clone https://github.com/<usuario>/Gestion-Taller-Mecanico.git<br>
cd Gestion-Taller-Mecanico


2️⃣ Instalar dependencias

composer install<br>
npm install


3️⃣ Configurar el entorno

cp .env.example .env<br>
php artisan key:generate


4️⃣ Configurar la base de datos en .env (reemplazar las siguientes lineas):
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_de_talleres
DB_USERNAME=root
DB_PASSWORD=

5️⃣ Ejecutar las migraciones

php artisan migrate


6️⃣ Iniciar el servidor

php artisan serve


Visitar en el navegador 👉 http://127.0.0.1:8000

🌟 Estado Actual del Proyecto

Actualmente en desarrollo (fase de implementación del backend y estructura base).
Las próximas etapas incluyen la integración del panel administrativo, vistas dinámicas y pruebas funcionales del sistema completo.