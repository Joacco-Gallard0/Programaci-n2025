Trabajo Práctico – Catálogo de Películas
Profesor: Bruno Cano
Alumno: Gallardo Joaquín

*****************************************
Descripción del proyecto
*****************************************
El proyecto es un catálogo de películas hecho en PHP.  
Las películas se guardan en un archivo json externo y se cargan al iniciar la página.  
El usuario puede agregar nuevas películas mediante un formulario.  
También se usa una clase en PHP para aplicar Programación Orientada a Objetos.

*****************************************
Funciones, arrays y clases utilizadas
*****************************************
Arrays:
  Se usa un array para almacenar todas las películas cargadas del json.

Funciones PHP:
  json_encode(), json_decode(), file_get_contents(), file_put_contents(), trim(), count(), htmlspecialchars().

Clase Pelicula:
  Incluye propiedades, constructor, un getter y un método estático usado para mostrar el saludo principal.

*****************************************
Descripción breve de los archivos
*****************************************
index.php: archivo principal. Carga el json, convierte datos a objetos, muestra el listado y procesa el formulario.  
clases/pelicula.php: contiene la clase Pelicula usada para representar cada película.  
data/peliculas.json: archivo donde se guardan las películas.  
assets/css/style.css: estilos del sitio.  
assets/js/script.js: muestra/oculta el formulario y valida los campos.
