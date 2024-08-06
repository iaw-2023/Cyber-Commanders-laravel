## Entrega 1 - Cyber-Commanders-laravel
- Delgado, Romina
- Talmon, Federico

## Proyecto Framework PHP - Laravel
### Entidades se podrán actualizar
    -Las salas
    -Las funciones
    -Los extras
### Reportes se podrán generar o visualizar
    -las funciones programadas
    -Las funciones para cada película
    -Las salas del cine.
    -Listado de los extras
    -Las películas en cartelera.
### Entidades se podrán obtener por API
    -Las películas
    -Las funciones
    -Los extras
### qué entidades se podrán modificar por API
    - Por el momento ninguna, ya que desde el front lo que va a poder hacer un comprador es
    adquirir entradas. Por cada entrada que compre, se creara un nuevo elemento en la base
    de datos, pero no se modificara ninguno.
    
## Proyecto Javascript - React/Vue
### Que información podrá ver el usuario
    -Las distintas funciones según la fecha
    -Los productos que puede agregar a una entrada (comida,bebida)
    -Se podría agregar a futuro un detalle de cada película en cartelera como el reparto, director, una descripción etc...

### Que acciones podrá realizar, ya sea la primera vez que ingrese a la aplicación como futuros accesos a la misma
    -Ver funciones
    -Ver peliculas
    -Comprar entradas para funciones e incorporar extras tales como bebidas y/o comidas.
# Examen final: Solo realizado por Federico Talmon.


### Entrega: Agosto 2024

Durante la cursada solo se completo la funcionalidad basica de la aplicacion, por lo que se debieron implementar de forma posterior todas las funcionalidades necesarias para aprobar el examen final .

## Funcionalidades
- ### Reponsive en js
   El proyecto de React es adaptable a las distintas pantallas segun corresponda en su tamaño. En los componentes mas sencillos se logra utilizando tailwind, y en aquellos mas complejos/personalizados se utiliza CSS puro.
- ### Roles en Laravel
    Distingui distintos tipos de usuarios en el back-end. Cada tipo de usuario tiene un "cargo" distinto dentro del cine.

~~~
Admin salas: Es el encargado de crear, modificar o eliminar salas

User:adminSalas@gmail.com
Password:adminSalas
~~~
~~~
Admin Pelis: Se encarga de cargar, modificar o eliminar peliculas y funciones.

User:adminPelis@gmail.com
Password:adminPelis
~~~
~~~
Admin Extras: Lo imagine como un empleado del candy-bar, por lo que se encarga del manejo de stock de productos del mismo. Agrega, modifica y elimina "extras" (productos del candy bar).

User:adminExtras@gmail.com
Password:adminExtras
~~~
~~~
SuperAdmin: Tiene la capacidad de crear, modificar o eliminar cualquier entidad dentro del sistema

User:superAdmin@gmail.com
Password:superAdmin
~~~
- ### Servicio web en Laravel
    Para agregar funcionalidad extra en el back-end, se consume la API de themoviedb.org, desde la cual pude obtener un conjunto de peliculas, con su nombre y un poster. Este servicio fue de utilidad para no tener que cargar peliculas a mano a la base de datos.

- ### Servicio web en JS
    En el front-end, utilice un servicio de email llamado emailjs, el cual se encarga de enviar un correo electronico a una persona al momento de finalizar la compra de su entrada con informacion util para el usuario (fecha y hora de la funcion, asi como tambien un listado de productos adquiridos en el candy bar). 

- ### PWA
    Se desarrollo la funcionalidad de PWA, permitiendo que el proyecto de JS se pueda "instalar" como aplicacion tanto en Desktop, como en telefonos. 

- ### Accesibilidad
 Se implementaron estas tres guias de accesibilidad
- https://www.w3.org/WAI/perspective-videos/keyboard/
- https://www.w3.org/WAI/perspective-videos/contrast/
- https://www.w3.org/WAI/perspective-videos/speech/

- ### Administracion de archivos
  A la hora de guardar una nueva pelicula, las imagenes se almacenan en un bucket de supabase. 

- ### MercadoPago
    Implementé el modulo de "card payment brick". Luego de seleccionar una funcion, mas los extras, se muestra la pantalla del brick de mercadopago. Para usarlo en modo sandbox se pueden colocar las siguientes credenciales.

    * Tarjeta: Mastercard
    * N° de tarjeta: 5031 7557 3453 0604
    * Cod.Seguridad: 123
    * Vencimiento: 11/25
 
- ### Autenticacion de usuarios en JS
    Se utiliza Auth0 para autenticar a los usuarios en el front-end. En este proceso, los usuarios generan tokens que luego sirven para 
    * Guardar la compra del usuario.
    * Recuperar las compras del usuario.
- ### Uso de la IA Gemini
    En el hipotetico caso de que un cliente no sepa que pelicula mirar, puede utilizar Gemini y buscar una pelicula ingresando palabras clave de su interes. Por ejemplo, al buscar "pelicula argentina", Gemini analiza el listado de peliculas que se encuentran en la base de datos y podria devolver, por ejemplo, Nueve reinas.

