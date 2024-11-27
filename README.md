<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

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

