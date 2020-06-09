# Código fuente del ECCBIO

## Información relevante acerca de la implementación:

- **php-mcrypt** Se requiere esta extensión para el panel de administración.

- **jsvars.php** (Definir aquí las siguientes variables, este archivo es incluido en index.php, utilizar jsvars.php.example como base)
	- home: establecer aquí el nombre de la base de datos MySQL con la que se importaron los datos.
	- idPais: 1 para México (constante)
	- key: Google API Key para usar el framework de Google Maps


- **Panel/base.php** (Definir aquí los datos para la conexión a la BD utilizar Panel/base.php.example como base)

- **Panel/host.php** (Definir aquí la url donde habitará el Explorador, utilizar Panel/host.php.example como base)
