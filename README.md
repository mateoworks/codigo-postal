## API para consulta de código postal

API básica para la consulta de estados, municipios y asentamientos humanos, puedes consultar codigos postales también, si deseas agregar más endpoints puedes hacerlo.
La base de datos la conseguí [aquí](https://pharalax.com/blog/base-de-datos-de-estados-municipios-y-localidades-de-mexico/)
El archivo de la base de datos esta en la raíz de este directorio y se llama BD.sql

## Endpoints agregados

```
/estados
/estados/{id}
/estados/{id}/municipios

/municipios
/municipios/{id}
/municipios/{id}/asentamientos

/asentamientos
/asentamientos/{id}

/cp/{cp}

```

## Instalación del proyecto

Para realizar la instalación sería como la de cualquier otro proyecto de laravel.
Configurar al archivo .env de acuerdo a su servidor.

```
git clone https://github.com/mateoworks/codigo-postal.git
composer install
copy .env.example .env
```

Importar la base de datos de MYSQL en su gestor de su preferencia y configurar en .env

```
DB_HOST=localhost
DB_DATABASE=tu_base_de_datos
DB_USERNAME=root
DB_PASSWORD=
```

Crear una nueva API key

```
php artisan key:generate
```
