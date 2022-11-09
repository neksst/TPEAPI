# API PELICULAS

## Tabla de ruteo
| URL          | Verbo        | Controller    | Metodo      |
| -----------  | -----------  | ------------- | ---------   |
| peliculas    |  GET         | ApiController | [getMovies()](https://github.com/agustudai/TPEAPI/blob/main/Controller/ApiController.php#L27) |
| peliculas/:ID|  GET         | ApiController | [getMovie()](https://github.com/agustudai/TPEAPI/blob/main/Controller/ApiController.php#L51)  |
| peliculas    |  POST        | ApiController | [AddMovie()](https://github.com/agustudai/TPEAPI/blob/main/Controller/ApiController.php#L65)  |
| peliculas/:ID    |  PUT         | Apicontroller | [EditMovie()](https://github.com/agustudai/TPEAPI/blob/main/Controller/ApiController.php#L83) |
| peliculas/:ID    |  DELETE      | Apicontroller | [DeleteMovie()](https://github.com/agustudai/TPEAPI/blob/main/Controller/ApiController.php#L106/)



## `GET` `/peliculas`
Retorna como resultado una coleccion entera de entidades.

## `GET` `/peliculas/:ID`

Retorna como resultado una identidad por su ID. 

Ejemplo:
`peliculas/24`

Salida
#### Código de respuesta 200 OK
```json
    {
    "ID": 24,
    "Titulo": "El hombre araña",
    "Fecha": 2002,
    "Productor": "Sam Raimi",
    "Descripcion": "Luego de sufrir la picadura de una araña genéticamente modificada, un estudiante de secundaria tímido y torpe adquiere increíbles capacidades como arácnido. Pronto comprenderá que su misión es utilizarlas para luchar contra el mal y defender a sus vecinos.",
    "Calificacion": 5,
    "Img": null,
    "id_genero_fk": 2
}
```
#### Código de respuesta en caso de error: `Pelicula no encontrada 404`

## `POST` `/peliculas`
#### IMPORTANTE: REQUIERE TOKEN DE AUTENTICACION

Crea una nueva identidad.
Se debe utilizar el body con el siguiente formato JSON:


```json
{
        "Titulo": string,
        "Fecha": Integer,
        "Productor": String,
        "Descripcion": String,
        "Calificacion": int(min 1, max5),
        "id_genero_fk": int
    }
```
#### Código de respuesta `201 Created`
#### Codigos de respuesta en caso de error `Ingrese una Calificacion min 1 max 5, 400`, `Complete los campos, 400`

## `PUT` `/peliculas/:ID`
#### IMPORTANTE: REQUIERE TOKEN DE AUTENTICACION

Modifica un identidad existente

Ejemplo `/peliculas/24`
##### Entidad existente

```json
    {
    "ID": 24,
    "Titulo": "El hombre araña",
    "Fecha": 2002,
    "Productor": "Sam Raimi",
    "Descripcion": "Luego de sufrir la picadura de una araña genéticamente modificada, un estudiante de secundaria tímido y torpe adquiere increíbles capacidades como arácnido. Pronto comprenderá que su misión es utilizarlas para luchar contra el mal y defender a sus vecinos.",
    "Calificacion": 5,
    "Img": null,
    "id_genero_fk": 2
}
```
Enviamos la siguiente petición:

```json
    {
    "Titulo": "El hombre hormiga",
    "Fecha": 2022,
    "Productor": "Sam Raimi",
    "Descripcion": "Luego de sufrir la picadura de una hormiga genéticamente modificada, un estudiante de secundaria tímido y torpe adquiere increíbles capacidades como hormiga. Pronto comprenderá que su misión es utilizarlas para luchar contra el mal y defender a sus vecinos.",
    "Calificacion": 1,
    "id_genero_fk": 2
}
```

#### Resultado:

```json
    {
    "ID": 24,
    "Titulo": "El hombre hormiga",
    "Fecha": 2022,
    "Productor": "Sam Raimi",
    "Descripcion": "Luego de sufrir la picadura de una hormiga genéticamente modificada, un estudiante de secundaria tímido y torpe adquiere increíbles capacidades como hormiga Pronto comprenderá que su misión es utilizarlas para luchar contra el mal y defender a sus vecinos.",
    "Calificacion": 1,
    "Img": null,
    "id_genero_fk": 2
}
```
#### Código de respuesta `200 OK`
#### Códigos de respuesta en caso de error `Ingrese una Calificacion min 1 max 5, 400`, `No se encuentra la Pelicula con el ID,404`


## `DELETE` `/peliculas/:ID`

Borra una entidad existente

Ejemplo `/peliculas/24` 
#### Si la entidad existe devolverá como respuesta `Pelicula borrada,200` de lo contrario nos devolverá `La pelicula con el ID no existe, 404`

## FIltrar por calificacion 
`/peliculas?rate={int: min 1 max 5}`

Filtra todas la peliculas con 
