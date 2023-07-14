Instalación de Breeze: composer require laravel/breeze --dev
php artisan breeze:install
npm install -> luego ya para guardar cambios de estilos: npm run watch o npm run dev

git clone https://github.com/MarcoGomesr/laravel-validation-en-espanol.git resources/lang


Ctrl + P -> Para buscar archivos en el proyecto

El proyecto para autentificar (registrarse y loguearse) utiliza Breeze, esto te divide en muchos componentes el proyecto en las vistas auth y components, y te crea un routes auth.php

mailtrap.io -> Hemos utilizado esta web online https://mailtrap.io/inboxes en la que nos van a llegar los correos de confirmación al crear una cuenta.
Se configura en My Inbox, en Integrations seleccionas Laravel 7+ y esas credenciales las pasas al .env

El mensaje del correo de validación lo hemos configurado en los Providers, en el archivo AuthServiceProvider.php


Hemos realizado la función de crear una vacante, y de mostrar las vacantes mediante Livewire, se intala escribiendo composer require livewire/livewire
Posteriormente en el app.blade.php hemos añadido  @livewireStyles y @livewireScripts (Esta es la documentación de instalación https://laravel-livewire.com/docs/2.x/installation)
--> si te pone livewire is not defined tirar esto -> php artisan livewire:publish --assets
--> posteriormente te sale algún error 404 tirar en livewire tirar para limpiar -> php artisan optimize
Luego hemos escrito php artisan make:livewire crear-vacante y nos crea 2 archivos uno para la vista crear-vacante.blade.php y otro como de controlador CrearVacante.php
Luego hemos escrito php artisan make:livewire mostrar-vacantes y nos crea 2 archivos uno para la vista mostrar-vacantes.blade.php y otro como de controlador MostrarVacantes.php
Consultar en estos 2 archivos lo que se ha hecho y como se pinta en la vista de /vacantes/index.blade.php y /vacantes/create.blade.php
TODO ESTA ALLÍ EN ESOS ARCHIVOS, REVISAR SU FUNCIONAMIENTO PARA ENTENDERLO
