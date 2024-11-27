<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Antes de ejecutar el proyecto

Se debe adquirir una clave de API de Google Maps, para ello se debe crear una cuenta en el sitio web de Google Cloud Platform.

Luego, se debe crear una aplicación de Google Cloud Platform, con la cual se podrá obtener la clave de API.

Una vez que se ha obtenido la clave de API, se debe crear un archivo llamado .env en la raíz del proyecto, y se debe agregar la clave de API en el archivo .env, con el nombre GOOGLE_API_KEY.

Para obtener la clave de API, se debe seguir los siguientes pasos:

1. [Ir a la página de la aplicación de Google Cloud Platform](https://console.cloud.google.com/welcome/new?hl=es-419&organizationId=0).
2. Crear o selecionnar un proyecto.
3. Si su cuenta es nueva google solicitará datos de una tarjeta, pero tranquilo no se le generaran costos.
4. Una vez que se ha creado el proyecto, se debe seleccionar la opción "Claves y Credenciales".
5. Luego la opcion de "Crear Credenciales", se debe seleccionar "API Key" o "Clave API".
6. Despues debe deleccionar la opcion "Mostrar clave", y copiar la clave.
7. Luego debe agregar la clave en el archivo .env en la raíz del proyecto, con el nombre API_KEY.

## Instalación de dependencias

Para poder ejecutar el proyecto una vez clonado, se debe instalar las dependencias de npm, con el siguiente comando:

npm install

Esto instalará las dependencias necesarias para ejecutar el proyecto.

## Migración de la base de datos

Para poder utilizar el proyecto, se debe configurar la conexión a la base de datos, y migrar la base de datos.

En el archivo .env debe configurar la conexion a su base de datos, con el siguiente formato:

- DB_CONNECTION=[Base de datos de tu preferencia]
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=[Nombre de la base de datos]
- DB_USERNAME=[Usuario de la base de datos]
- DB_PASSWORD=[Contraseña de la base de datos]

Para poder ejecutar el proyecto, se debe migrar la base de datos, con el siguiente comando:

php artisan migrate

Con esto se crearán las tablas necesarias para el proyecto.

## Ejecución de los seeders

Para poder ejecutar los seeders, se debe ejecutar el siguiente comando:

php artisan db:seed

Esto ejecutará los seeders necesarios para crear los datos necesarios para el proyecto.

## Ejecución del proyecto

Para poder ejecutar el proyecto, se debe ejecutar el siguiente comando:

php artisan serve

Esto ejecutará el servidor web de Laravel, y se podrá acceder a la aplicación en el siguiente enlace: http://localhost:8000

## Usuarios de prueba

Si desea puede crear un usuario cuando esta ejecutado el proyecto o puede utilizar los siguientes usuarios:

- Usuario Organizador
    Correo => organizador@ejemplo.com
    Contraseña => organizador

- UsuarioInvitado
    Correo => invitado@ejemplo.com
    Contraseña => invitado

## Licencia

El proyecto está licenciado bajo la licencia MIT.

## Colaboradores

- [Lesteyme Alexis](https://github.com/jlperez).
- [Lesteyme Facundo ](https://github.com/Facundo-lesteyme) .
- [Malveira Marcos](https://github.com/Perruni).


