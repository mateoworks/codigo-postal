## API para consulta de código postal

API básica para la consulta de estados, municipios y asentamientos humanos, puedes consultar codigos postales también, si deseas agregar más endpoints puedes hacerlo.
La base de datos la conseguí [aquí](https://pharalax.com/blog/base-de-datos-de-estados-municipios-y-localidades-de-mexico/)
El archivo de la base de datos esta en la raíz de este directorio y se llama BD.sql

## Endpoints agregados

`/estados`
Lista de estados de México

```json
{
    "data": [
        {
            "id": 1,
            "nombre": "Oaxaca",
            "abrev": "Oax."
        }
    ]
}
```

## Istalación
