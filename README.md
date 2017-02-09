# Configuración del proyecto

Asegúrese de tener instalados los siguientes programas de línea de comandos:

  * curl
  * zip
  * unzip

Y tener un servidor web apache configurado para ejecutar PHP.

Clone el repositorio con la aplicación de ejemplo:

    git clone https://github.com/Tpaga/tpaga-php-example-backend

Luego, entre a la carpeta del repositorio, y ejecute los siguientes comandos:

    # instalar el manejador de paquetes PHP
    curl -sS https://getcomposer.org/installer | php

    # instalar las librerías necesarias para hacer peticiones HTTP/REST con PHP
    php composer.phar require guzzlehttp/guzzle:~6.0

Luego de hacer esto, puede copiar el contenido de la carpeta al directorio raíz
del servidor web. Por ejemplo:

    cp -r tpaga-php-example-backend /var/www/html

Luego de hacer esto, debe poder acceder a la aplicación desde su navegador.
