# Growpro

## Decisiones técnicas:

La applicación está escrita en `PHP 8.2`,
usando `arquitectura hexagonal` para separar la aplicación en diferentes capas,
y cada una con su responsabilidad.

## Frameworks/librerias

El único framwork utilizado es `PHPUnit`, este nos facilita la escritura y ejecución de pruebas unitarias

## Cómo compilar y correr los test

El proyecto está dockerizado, y para su fácil ejecución en entornos Unix se ha escrito un makefile:

| Step |         Command          |                                              Description                                              |
|:----:|:------------------------:|:-----------------------------------------------------------------------------------------------------:|
|  1   |        `make up`         |                                    Crea el contenedor y lo inicia.                                    |
|  2   |      `make install`      |            Instala los paquetes necesarios para correcto funcionamiento de la applicatión.            |
|  3   | `make composer-autoload` | Se utiliza para autocargar las diferentes clases de la aplicación y tener un correcto funcionamiento. |
|  4   |       `make test`        |                 Corre los test para verificar que el código cumple con lo solicitado                  |
