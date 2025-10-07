Las rutas están montadas para que el proyecto funcione en htdocs/biblioteca, puede dar error si no esté así.

Es posible que si la carpeta htdocs/images no está creada, de error para insertar imágen.

- Navegación de la web:

> Rutas para autentificación
>
> http://localhost/biblioteca/register.php
> 
> http://localhost/biblioteca/login.php

---

> Ruta pública donde se ven todos los libros, sin necesidad de autentificación.
>
> http://localhost/biblioteca/home.php
>
> ---
>
> Al clicar en el título de alguno de los títulos se navegará a la ruta details con los detalles de un libro concreto
>
> http://localhost/biblioteca/details.php?book=book-id-example

---

> Ruta protegida donde se verán los libros del usuario que ha iniciado sesión, se podrán insertar nuevos libros y modificar libros existentes:
>
> http://localhost/biblioteca/dashboard.php