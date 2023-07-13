Instalación de Breeze: composer require laravel/breeze --dev
php artisan breeze:install
npm install -> luego ya para guardar cambios: npm run watch o npm run dev

git clone https://github.com/MarcoGomesr/laravel-validation-en-espanol.git resources/lang


Ctrl + P -> Para buscar archivos en el proyecto

El proyecto para autentificar (registrarse y loguearse) utiliza Breeze, esto te divide en muchos componentes el proyecto en las vistas auth y components, y te crea un routes auth.php

mailtrap.io -> Hemos utilizado esta web online https://mailtrap.io/inboxes en la que nos van a llegar los correos de confirmación al crear una cuenta.
Se configura en My Inbox, en Integrations seleccionas Laravel 7+ y esas credenciales las pasas al .env

El mensaje del correo de validación lo hemos configurado en los Providers, en el archivo AuthServiceProvider.php




