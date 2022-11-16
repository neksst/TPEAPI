# API PELICULAS

## Tabla de ruteo
| URL          | Verbo        | Controller    | Metodo      |
| -----------  | -----------  | ------------- | ---------   |
| peliculas    |  GET         | ApiController | [getMovies()](https://github.com/agustudai/TPEAPI/blob/main/Controller/ApiController.php#L27) |
| peliculas/:ID|  GET         | ApiController | [getMovie()](https://github.com/agustudai/TPEAPI/blob/main/Controller/ApiController.php#L51)  |
| peliculas    |  POST        | ApiController | [AddMovie()](https://github.com/agustudai/TPEAPI/blob/main/Controller/ApiController.php#L65)  |
| peliculas/:ID    |  PUT         | Apicontroller | [EditMovie()](https://github.com/agustudai/TPEAPI/blob/main/Controller/ApiController.php#L83) |
| peliculas/:ID    |  DELETE      | Apicontroller | [DeleteMovie()](https://github.com/agustudai/TPEAPI/blob/main/Controller/ApiController.php#L106/)|
| auth/token    | GET          | AuthController  | [getToken()](https://github.com/agustudai/TPEAPI/blob/main/Controller/AuthController.php#L34)|



## `GET` `/peliculas`
Retorna como resultado una coleccion entera de entidades.

## `GET` `/peliculas/:ID`

Retorna como resultado una registro por su ID. 

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

Crea una nuevo registro.
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

Modifica un registro existente

Ejemplo `/peliculas/24`
##### registro existente

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

## `GET` `/auth/token`

Obtiene un token único por usuario que permite realizar acciones de POST, PUT y DELETE.

Importante: Para obtener un Token se debe tener un usuario en el sitio peliculas.


Como cabezera de autenticazion debe ser 'Basic Auth' e ingresar los datos de login de usuario
![image](https://user-images.githubusercontent.com/51015162/201585879-01e5e0a2-add5-45ca-9fc9-5d657fd92025.png)

Para utilizar el Token dado, en cualquier accion POST, PUT y DELETE debe utilizar como cabezera de autenticacion 'Bearer Token'

Por ejemplo:
![image](https://user-images.githubusercontent.com/51015162/201586341-f0d02df1-efed-4726-8218-5fc4b4a3903c.png)





## FIltrar por calificacion 
`/peliculas?rate={int: min 1 max 5}`

Permite filtrar peliculas por una calificacion determinada tomando como valor un numero entero entre 1 y 5.

Ejemplo: Filtrar todas la peliculas con calificacion 5 `/peliculas?rate=5` :
```json
[
    {
        "ID": 1,
        "Titulo": "El padrino",
        "Fecha": 1972,
        "Productor": "Albert S. Ruddy",
        "Descripcion": "Don Vito Corleone es el respetado y temido jefe de una de las cinco familias de la mafia de Nueva York en los años 40. El hombre tiene cuatro hijos: Connie, Sonny, Fredo y Michael, que no quiere saber nada de los negocios sucios de su padre. Cuando otro capo, Sollozzo, intenta asesinar a Corleone, empieza una cruenta lucha entre los distintos clanes.",
        "Calificacion": 5,
        "Img": "static/img/634ce80d7aca7.jpg",
        "id_genero_fk": 1
    },
    {
        "ID": 7,
        "Titulo": "Taxi Driver",
        "Fecha": 1976,
        "Productor": "Martin Scorsese",
        "Descripcion": "Un veterano de Vietnam inicia una confrontación violenta con los proxenetas que trabajan en las calles de Nueva York.",
        "Calificacion": 5,
        "Img": null,
        "id_genero_fk": 1
    },
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
]
```
## Paginacion

Agrupa una cantidad determinada de resultados.
`/peliculas?page={int}&limit={int}`

| Parámetro | Descripcion |
|-----------|-------------|
| page={int}|Selecciona el registro de donde comenzará a paginarse|
| limit={int}|Limite de resultados|

En caso de que el limite no este definido, la cantidad de resultados sera de 10.

Ejemplo de uso: `peliculas?page=3&limit=5`

```json
[
    "Cantidad: 5",
    [
        {
            "ID": 4,
            "Titulo": "Caracortada",
            "Fecha": 1984,
            "Productor": "Martin Bregman",
            "Descripcion": "Un inmigrante cubano de las cárceles de Fidel Castro provoca un camino de destrucción en su ascenso en el mundo de las drogas de Miami.",
            "Calificacion": 4,
            "Img": null,
            "id_genero_fk": 1
        },
        {
            "ID": 5,
            "Titulo": "Donnie Brasco",
            "Fecha": 1997,
            "Productor": "Louis DiGiaimo",
            "Descripcion": "Un agente del FBI usa su amistad con un matón para infiltrarse en la mafia. Basada en una historia verdadera.",
            "Calificacion": 4,
            "Img": null,
            "id_genero_fk": 1
        },
        {
            "ID": 6,
            "Titulo": "Casino",
            "Fecha": 1996,
            "Productor": "Martin Scorsese",
            "Descripcion": "En Las Vegas, en 1973, Sam Rothstein es un profesional de las apuestas y director de un importante casino que pertenece a unos mafiosos. Un día, el violento Nicky Santoro llega a la ciudad y con él vi",
            "Calificacion": 2,
            "Img": null,
            "id_genero_fk": 1
        },
        {
            "ID": 7,
            "Titulo": "Taxi Driver",
            "Fecha": 1976,
            "Productor": "Martin Scorsese",
            "Descripcion": "Un veterano de Vietnam inicia una confrontación violenta con los proxenetas que trabajan en las calles de Nueva York.",
            "Calificacion": 5,
            "Img": null,
            "id_genero_fk": 1
        },
        {
            "ID": 8,
            "Titulo": "Pulp Fiction",
            "Fecha": 1995,
            "Productor": "Quentin Tarantino",
            "Descripcion": "La vida de un boxeador, dos sicarios, la esposa de un gánster y dos bandidos se entrelaza en una historia de violencia y redención.",
            "Calificacion": 4,
            "Img": null,
            "id_genero_fk": 1
        }
    ]
]
```

## Orden por campo

`/peliculas?field={campo}&order=ASC/DESC`

| Parámetro | Descripcion |
|-----------|-------------|
| field={campo}|Selección del campo a ordenar|
| order={ASC/DESC} | Ordenar de manera ascendente(ASC) o descendente(DESC)|

## Ordenar pelicula por fecha de salida

`peliculas?orderByDate={ASC/DESC}`

Ordena todas las peliculas de manera ascendente o descendente.
