# 📌 Sistema de Control de Asistencia - PHP + MySQL + MVC

Este es un **Sistema de Control de Asistencia** desarrollado de forma grupal en **PHP** utilizando el **modelo MVC**. Permite gestionar y registrar la asistencia de los alumnos de manera eficiente, así como agregar y gestionar nuevos cursos/bloques y alumnos.

Integrantes:

- Daniel Eduardo Villafranqui Colquicocha
- Pedro Alessandro Rodenas Aponte
- Katherine Michelle Alanya Huayunga
- Alessandro Santos Medina Mamani


## 🚀 Instalación y Configuración

Para ejecutar esta aplicación en tu entorno local, sigue estos pasos:


### ✅ **1. Requisitos Previos**
Antes de empezar, asegúrate de tener instalado:
- Un servidor local como **XAMPP** ([Descargar aquí](https://www.apachefriends.org/es/index.html))
- **PHP 7.4+** (incluido en XAMPP)
- **MySQL / phpMyAdmin** (para manejar la base de datos)


### 🔹 **2. Descargar y Configurar el Proyecto**
1. **Descargar el código fuente** desde el repositorio:
2. **Renombrar** la carpeta principal a **"SistemaControlAsistencia"**.
3. Mover la carpeta **SistemaControlAsistencia** a la carpeta htdocs dentro de la instalación de XAMPP:
> C:\xampp\htdocs\SistemaControlAsistencia


### 🔹 **3. Configurar la Base de Datos**
1. Iniciar XAMPP y asegurarse de que Apache y MySQL estén corriendo.
2. Abrir un navegador y acceder a phpMyAdmin:
> http://localhost/phpmyadmin
3. Crear una nueva base de datos con el nombre:
> asistencia
4. Importar el archivo .sql ubicado en la carpeta del proyecto (/database/sistema_asistencia.sql):
- Ir a Importar en phpMyAdmin.
- Seleccionar el archivo SQL y ejecutar la importación.


### 🔹 **4. Configurar el Archivo de Conexión**
Si tu base de datos tiene credenciales distintas, edita el archivo de conexión:

📂 Ruta: `app/config/conexion.php`

```
$host = 'localhost';
$usuario = 'root'; // Cambiar si usas otro usuario
$contraseña = ''; // Si tienes contraseña, agrégala aquí
$database = 'asistencia';
```

### 🔹 **5. Iniciar la Aplicación**
1. Asegúrate de que **Apache** y **MySQL** estén corriendo en XAMPP.
2. Abre tu navegador y accede a la aplicación:
> http://localhost/SistemaControlAsistencia/